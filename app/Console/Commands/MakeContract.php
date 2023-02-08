<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeContract extends GeneratorCommand
{
    protected $signature = 'make:contract {name : Contract name} {--m|model=} {--f|fillable} {--p|pivot}';

    protected $description = 'Create a new contract';

    protected $type = 'Contract';

    public function handle(): ?bool
    {
        return parent::handle();
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Contracts';
    }

    protected function getStub(): string
    {
        return $this->option('model') ?
            app_path('Console/Commands/stubs/contract.stub') :
            app_path('Console/Commands/stubs/contract.plain.stub');
    }

    protected function replaceClass($stub, $name): array|string
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace(['{{ contract }}'], $class, $stub);
    }

    protected function buildClass($name): string
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->handleOptions($stub)->replaceClass($stub, $name);
    }

    protected function handleOptions(&$stub): static
    {
        if ($model = $this->option('model')) {

            if (Str::of($model)->ucsplit()->count() > 1) {

                $segments = Str::of($model)->ucsplit();

                if ( ! $this->option('pivot')) {
                    $last = $segments->pop();
                    $segments->push(Str::of($last)->plural());
                }

                $table_name = strtolower($segments->join('_'));

            } else {
                $table_name = Str::of($model)->plural()->lower();
            }

            $stub = str_replace(['{{ table }}'], $table_name, $stub);

            if (Schema::hasTable($table_name)) {

                $fields = '';
                $field_stub = "public const FIELD_{{ field_const }} = '{{ field_name }}';";
                $columns = collect(Schema::getColumnListing($table_name));

                foreach ($columns as $column) {

                    if ( ! in_array($column, ['created_at', 'updated_at', 'deleted_at'])) {
                        $fields .= Str::of($field_stub)
                            ->replace('{{ field_const }}', Str::of($column)->upper())
                            ->replace('{{ field_name }}', $column)
                            ->append("\n\t");
                    }

                }

                if ($this->option('fillable')) {
                    $fillable_list = 'public const FILLABLE = [';
                    $fillable_stub = 'self::FIELD_';

                    foreach ($columns as $column) {

                        if ($column != 'id') {
                            $fillable_list .= Str::of("\n\t\t")
                                ->append($fillable_stub)
                                ->append(Str::of($column)->upper(), ',')
                                ->append("\t\t");
                        }

                    }

                    $fillable_list .= "\n\t];";

                    $stub = str_replace(['{{ fillable }}'], $fillable_list, $stub);

                }

                $stub = str_replace(['{{ fields }}'], $fields, $stub);

            }
        }

        $stub = str_replace(['{{ fillable }}', '{{ fields }}'], '', $stub);

        return $this;
    }

}
