<div class="card-header">
    <form>
        <div class="row align-items-center">
            <div class="col">
                @if(request('type'))
                    <input type="hidden" name="type" value="{{ request('type')}}">
                @endif
                @if(request('parent_id'))
                    <input type="hidden" name="parent_id" value="{{ request('parent_id')}}">
                @endif
                <div class="input-group input-group-flush input-group-merge input-group-reverse">
                    <input class="form-control list-search" name="q" value="{{ request('q') }}" type="text" placeholder="Поиск">
                    <span class="input-group-text">
                              <i class="fe fe-search"></i>
                            </span>
                </div>
            </div>
            <div class="col-auto">
                <!-- Dropdown -->
                <div class="dropdown">

                    <!-- Toggle -->
                    <button class="btn btn-sm btn-white" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class="fe fe-sliders me-1"></i> Фильтр <span class="badge bg-primary ms-1 d-none">0</span>
                    </button>

                    <!-- Menu -->
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Сортировка
                            </h4>
                        </div>
                        <div class="card-body">

                            <!-- List group -->
                            <div class="list-group list-group-flush mt-n4 mb-4">
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col">
                                            <small>Сортировка</small>
                                        </div>
                                        <div class="col-auto">
                                            <select name="sort" id="sortProductGroupSelect" class="quasar-select__input radio-form form-select" aria-labelledby="sortProductGroupSelectLabel" aria-invalid="false">
                                                <option @if(request('sort') == 'new') selected @endif value="new">Сначала новые</option>
                                                <option @if(request('sort') == 'old') selected @endif value="old">Сначала старые</option>
                                                <option @if(request('sort') == 'letter') selected @endif value="letter">По алфавиту</option>
                                            </select>
                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                            </div>

                            <!-- Button -->
                            <button class="btn w-100 btn-primary" type="submit">
                                Поиск
                            </button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>



{{--
<div class="col-auto">
    <div class="dropdown">
        <label class="btn btn-sm btn-white"  id="sortProductGroupSelectLabel" for="sortProductGroupSelect" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
            <i class="fe fe-sliders me-1"></i> Сортировка
        </label>
        <form class="dropdown-menu dropdown-menu-end dropdown-menu-card">
            <div class="card-body">
                <select name="sort" id="sortProductGroupSelect" class="quasar-select__input radio-form form-select" aria-labelledby="sortProductGroupSelectLabel" aria-invalid="false">
                    <option @if(request('sort') == 'new') selected @endif value="new">Сначала новые</option>
                    <option @if(request('sort') == 'old') selected @endif value="old">Сначала старые</option>
                    <option @if(request('sort') == 'letter') selected @endif value="letter">По алфавиту</option>
                </select>
            </div>
        </form>
    </div>
</div>--}}
