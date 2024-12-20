@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\PeralatanTelemetri::class)
                <a
                    href="{{ route('peralatan-telemetris.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <b>Peralatan Telemetri List</b>
        </div>
        <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
            <form class="form" method="GET" action="@lang('crud.forms.index_title')" class="col-md-4" style="width: 100%; padding: 0">
              <div class="form-group w-100 mb-3">
              </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">
                                Lokasi Stasiun
                            </th>
                            <th class="text-center">
                                Jenis Alat
                            </th>
                            <th class="text-center" style="width: 134px;">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peralatanTelemetris as $peralatanTelemetri)
                        <tr>
                            <td class="text-center">
                                {{ $peralatanTelemetris->firstItem() + $loop->index }}
                            </td>
                            <td class="text-center">
                                {{ $peralatanTelemetri->lokasiStasiun ?? '-' }}
                            </td>
                            <td class="text-center">
                                {{
                                optional($peralatanTelemetri->jenisAlat)->namajenis
                                ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $peralatanTelemetri)
                                    <a
                                        href="{{ route('peralatan-telemetris.edit', $peralatanTelemetri) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $peralatanTelemetri)
                                    <a
                                        href="{{ route('peralatan-telemetris.show', $peralatanTelemetri) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $peralatanTelemetri)
                                    <form
                                        action="{{ route('peralatan-telemetris.destroy', $peralatanTelemetri) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                {!! $peralatanTelemetris->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
