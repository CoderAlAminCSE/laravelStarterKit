@extends('backend.layout.master')
@section('title', ' SMTP Settings')
@section('content')
 <!--begin::Toolbar-->
 <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Settings</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Settings</li>
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">SMTP Settings</li>
                <!--end::Item-->
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
   <div id="kt_app_content_container" class="app-container container-xxl">

        <!--begin::Basic info-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">SMTP info</h3>
                </div>

                <div class="card-header d-flex justify-content-end py-6 px-9">
                    <form action="{{ route('smtp.connection.test') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Test
                            Connection</button>
                    </form>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form action="{{ route('smtp.update') }}" method="POST"
                    class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <!--begin::Row-->
                        <div class="row gx-10 mb-5">
                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <label class="form-label fs-6 fw-bold required text-gray-700 mb-3">Driver</label>
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" name="driver"
                                            data-control="select2" data-hide-search="true"
                                            data-placeholder="Select a layout">
                                            <option value="smtp"
                                                {{ env('MAIL_MAILER') === 'smtp' ? 'selected' : null }}>
                                                {{ __('SMTP') }} </option>
                                            <option value="sendmail"
                                                {{ env('MAIL_MAILER') === 'sendmail' ? 'selected' : null }}>
                                                {{ __('SENDMAIL') }}</option>
                                            <option value="mailgun"
                                                {{ env('MAIL_MAILER') === 'mailgun' ? 'selected' : null }}>
                                                {{ __('MAILGUN') }}</option>
                                        </select>
                                        <!--end::Select2-->
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <label class="form-label fs-6 fw-bold required text-gray-700 mb-3">Port</label>
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <div class="controls">
                                        <input type="number" name="port" value="{{ env('MAIL_PORT') }}"
                                            class="form-control form-control-solid @error('port') is-invalid @enderror">
                                        @error('port')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <label class="form-label fs-6 fw-bold required text-gray-700 mb-3">Username</label>
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <div class="controls">
                                        <input type="text" name="username" value="{{ env('MAIL_USERNAME') }}"
                                            class="form-control form-control-solid @error('username') is-invalid @enderror">
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input group-->


                                <label class="form-label fs-6 fw-bold required text-gray-700 mb-3">Email From
                                    Address</label>
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <div class="controls">
                                        <input type="email" name="from" value="{{ env('MAIL_FROM_ADDRESS') }}"
                                            class="form-control form-control-solid @error('from') is-invalid @enderror">
                                        @error('from')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input group-->


                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <label class="form-label fs-6 fw-bold required text-gray-700 mb-3">Host</label>
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <div class="controls">
                                        <input type="text" name="host" value="{{ env('MAIL_HOST') }}"
                                            class="form-control form-control-solid  @error('host') is-invalid @enderror">
                                        @error('host')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <label class="form-label fs-6 fw-bold required text-gray-700 mb-3">Security</label>
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" name="encryption"
                                            data-control="select2" data-hide-search="true"
                                            data-placeholder="Select Encryption type">
                                            <option value=""
                                                {{ env('MAIL_ENCRYPTION') === '' ? 'selected' : null }}>
                                                {{ __('No Encryption') }}
                                            </option>
                                            <option value="tls"
                                                {{ env('MAIL_ENCRYPTION') === 'tls' ? 'selected' : null }}>
                                                {{ __('TLS') }}
                                            </option>
                                            <option value="ssl"
                                                {{ env('MAIL_ENCRYPTION') === 'ssl' ? 'selected' : null }}>
                                                {{ __('SSL') }}
                                            </option>
                                        </select>
                                        <!--end::Select2-->
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <label class="form-label fs-6 fw-bold required text-gray-700 mb-3">Password</label>
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <div class="controls">
                                        <input type="text" name="password" value="{{ env('MAIL_PASSWORD') }}"
                                            class="form-control form-control-solid @error('password') is-invalid @enderror">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input group-->


                                <label class="form-label fs-6 fw-bold required text-gray-700 mb-3">Email From
                                    Name</label>
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <div class="controls">
                                        <input type="text" name="from_name" value="{{ env('MAIL_FROM_NAME') }}"
                                            placeholder="Email From Name"
                                            class="form-control form-control-solid @error('from_name') is-invalid @enderror">
                                        @error('from_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary"
                            id="kt_account_profile_details_submit">Update</button>
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
