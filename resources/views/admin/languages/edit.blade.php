@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> اللغات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> اللغات
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div>

                        @section('content')

                            <div class="app-content content">
                                <div class="content-wrapper">
                                    <div class="content-header row">
                                        <div class="content-header-left col-md-6 col-12 mb-2">
                                            <div class="row breadcrumbs-top">
                                                <div class="breadcrumb-wrapper col-12">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="{{route('admin.languages')}}"> أللغات </a>
                                                        </li>
                                                        <li class="breadcrumb-item active">تعديل لغة
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-body">
                                        <!-- Basic form layout section start -->
                                        <section id="basic-form-layouts">
                                            <div class="row match-height">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title" id="basic-layout-form"> إضافة لغة </h4>
                                                            <a class="heading-elements-toggle"><i
                                                                    class="la la-ellipsis-v font-medium-3"></i></a>
                                                            <div class="heading-elements">
                                                                <ul class="list-inline mb-0">
                                                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @include('admin.includes.alerts.success')
                                                        @include('admin.includes.alerts.errors')
                                                        <div class="card-content collapse show">
                                                            <div class="card-body">
                                                                <form class="form" action="{{route('admin.languages.update',$language -> id)}}" method="POST"
                                                                      enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-body">
                                                                        <h4 class="form-section"><i class="ft-home"></i> بيانات  اللغة </h4>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="projectinput1"> اسم اللغة </label>
                                                                                    <input type="text"  id="name"
                                                                                           class="form-control"
                                                                                           value="{{$language -> name}}"
                                                                                           placeholder="ادخل اسم اللغة  "
                                                                                           name="name">
                                                                                    @error('name')
                                                                                    <span class="text-danger">{{$message}}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="projectinput1"> أختصار اللغة </label>
                                                                                    <input type="text" value="{{$language -> abbr}}" id="name"
                                                                                           class="form-control"
                                                                                           placeholder="ادخل أختصار اللغة  "
                                                                                           name="abbr">
                                                                                    @error('abbr')
                                                                                    <span class="text-danger">{{$message}} </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>



                                                                        <div class="row">

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="projectinput2"> الاتجاة </label>
                                                                                    <select name="direction" class="select2 form-control">
                                                                                        <optgroup label="من فضلك أختر اتجاه اللغة ">
                                                                                            <option value="rtl" @if($language ->direction == 'rtl' ) selected @endif>من اليمين الي اليسار</option>
                                                                                            <option value="ltr" @if($language ->direction == 'ltr') selected @endif>من اليسار الي اليمين</option>
                                                                                        </optgroup>
                                                                                    </select>
                                                                                    @error('direction')
                                                                                    <span class="text-danger">{{$message}}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label for="projectinput2"> أتاحة اللغة </label>
                                                                                    <select name="active" class="select2 form-control">
                                                                                        <optgroup label="تفعيل اللغة">
                                                                                            <option value="1"  @if($language ->active == '1' ) selected @endif>مفعل </option>
                                                                                            <option value="0"  @if($language ->direction == '0' ) selected @endif>غير مفعل</option>
                                                                                        </optgroup>
                                                                                    </select>
                                                                                    @error('active')
                                                                                    <span class="text-danger">{{$message}}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        {{-- <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group mt-1">
                                                                                    <input type="checkbox"  value="1" name="active"
                                                                                           id="switcheryColor4"
                                                                                           class="switchery" data-color="success"

                                                                                          @if($language -> active  == 1 ) checked @endif
                                                                                    />
                                                                                    <label for="switcheryColor4"
                                                                                           class="card-title ml-1">الحالة </label>

                                                                                    @error('active')
                                                                                    <span class="text-danger">{{$message}}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> --}}


                                                                    <div class="form-actions">
                                                                        <button type="button" class="btn btn-warning mr-1"
                                                                                onclick="history.back();">
                                                                            <i class="ft-x"></i> تراجع
                                                                        </button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            <i class="la la-check-square-o"></i>  تحديث
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- // Basic form layout section end -->
                                    </div>
                                </div>
                            </div>

                        @endsection
                        ="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع لغات الموقع </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered ">
                                            <thead>
                                            <tr>
                                                <th> الاسم</th>
                                                <th>الاختصار</th>
                                                <th>اتجاه</th>
                                                <th>الحالة</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($languages)
                                                @foreach($languages as $language)
                                                    <tr>
                                                        <td>{{$language ->name}}</td>
                                                        <td>{{$language ->abbr}}</td>
                                                        <td>{{$language ->direction}}</td>
                                                        {{-- <td>{{$language -> getActive()}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.languages.edit',$language -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                <a href="{{route('admin.languages.delete',$language -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>


                                                            </div>
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
