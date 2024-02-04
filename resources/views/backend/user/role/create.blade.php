@extends('backend.layout.master')
@section('title', 'Create - Role')
@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Basic info-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Create Roll</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form action="{{ route('role.store') }}" method="POST"
                    class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <label class="col-form-label required fw-semibold fs-6">Role name</label>
                            </div>
                            <div class="col-md-9">
                                <div class="fv-row">
                                    <input type="text" name="name"
                                        class="form-control form-control-lg form-control-solid" placeholder="name" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-3">
                                <label class="col-form-label required fw-semibold fs-6">Assign
                                    Permissions</label>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-4 mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" name="permissions[]" type="checkbox"
                                                    value="{{ $permission->id }}"
                                                    id="flexCheckChecked{{ $permission->id }}" />
                                                <label class="form-check-label" for="flexCheckChecked{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Basic info-->
    </div>
@endsection
