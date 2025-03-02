<div class="col-12 p-3 mt-5">
    @foreach ($details as $detail)
    <div class="accordion" id="accordionDetails">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse{{ $detail->id }}" aria-expanded="false"
                    aria-controls="collapse{{ $detail->id }}">
                    {{ strtoupper($detail->title) }}
                    
                </button>
            </h2>
            <div id="collapse{{ $detail->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="d-flex flex-wrap justify-content-center align-items-center gap-3">
                        <div class="d-flex justify-content-center">
                            @if ($detail->picture != NULL)
                            <img src="{{ asset($detail->picture->file_path) }}" alt="details_picture" class="w-50">
                            @endif
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    @if (Auth::check() && Auth::user()->role === 'superadmin')
                                    <div class="dropdown">
                                        <a href="" class="btn btn-primary dropdown-toggle" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#itemSubDescription-{{ $detail->id }}">
                                                    Add sub detail
                                                </button>
                                            </li>
                                            <li>
                                                <a href="{{ route(Auth::user()->role . '.itemDetail.edit', ['item' => $item->id, 'itemDetail' => $detail->id]) }}"
                                                    class="dropdown-item">Edit</a>
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route(Auth::user()->role . '.itemDetail.destroy', ['item' => $item->id, 'itemDetail' => $detail->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"
                                                        onclick="return confirm('Are you sure you want to delete this ' . $resource . ' ?')">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="fs-6 text-center">{{ $detail->details }}</span>
                            <ul>
                                @if ($detail->details === NULL)
                                @php
                                $subDetails = \App\Models\SubDescription::getSubDescription($detail->id);
                                @endphp
                                @foreach ($subDetails as $subDetail)
                                <li class="fs-6">
                                    {{ $subDetail->description }}
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($item->detail && Auth::check())
        @include('cms.modal.create-itemSubDescription')
        @endif
        @endforeach
    </div>
</div>