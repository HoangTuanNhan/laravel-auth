@extends("layouts.app")
@section('title', Lang::get('usersmanagement.show-user'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                 <div class="panel @if ($user->activated == 0) panel-success @else panel-danger @endif">
                     <div class="panel-heading">
                        <a href="/users/" class="btn btn-primary btn-xs pull-right">
                        <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                        <span class="hidden-xs">{{ trans('usersmanagement.usersBackBtn') }}</span>
                        </a>
                        {{ trans('usersmanagement.usersPanelTitle') }}
                    </div>
                     <div class="panel-body">
                          <div class="well">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!--Todo-->
                                    <img>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="text-muted margin-top-sm-1 text-center text-left-tablet">
                                       {{$user->name}}
                                    </h4>
                                </div>
                                <p class="text-center text-left-tablet">
                                    <strong>
                                    {{ $user->first_name }} {{ $user->last_name }}
                                    </strong>
                                    <br />
                                    {{ Html::mailto($user->email, $user->email)}}
                                </p>
                            
                                
                            </div>
                          </div>
                     </div>
                     <div class="clearfix"></div>
                    <div class="border-bottom"></div>
                    @if ($user->name)

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans("usersmanagement.labelUserName") }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user->name }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif
                    @if($user->email)
                         <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{trans("usersmanagement.labelEmail")}}
                            </strong>
                         </div>
                         <div class="col-sm-7">
                            {{ Html::mailto($user->email, $user->email) }}
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                    @endif
                    @if($user->first_name)
                         <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{trans("usersmanagement.labelFristName")}}
                            </strong>
                         </div>
                         <div class="col-sm-7">
                            {{ $user->first_name }}
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                    @endif
                    @if($user->last_name)
                         <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{trans("usersmanagement.labelLastName")}}
                            </strong>
                         </div>
                         <div class="col-sm-7">
                            {{ $user->last_name }}
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                    @endif
                     <div class="col-sm-5 col-xs-6 text-larger">
                        <strong>
                            {{ trans("usersmanagement.labelRole") }}
                        </strong>
                    </div>
                    <div class="col-sm-7">
                        @foreach($user->roles as $user_role)
                            @if ($user_role->name == "User")
                                <?php $labelClass = "primary"?>
                            @endif
                            @if($user_role->name == "Admin")
                                <?php $labelClass = "warning"?>
                            @endif
                             @if($user_role->name == "Unverified")
                                <?php $labelClass = "default"?>
                            @endif
                            <span class="label label-{{$labelClass}}">{{ $user_role->name }}</span>
                        @endforeach
                    </div>
                   
                    <div class="col-sm-5 col-xs-6 text-larger">
                        <strong>
                            {{ trans("usersmanagement.labelStatus") }}
                        </strong>
                    </div>
                    <div class="col-sm-7">
                        @if($user->activated == 1)
                           <span class="label label-success">Activated</span>
                        @else
                           <span class="label label-danger">Non-Activated</span>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>
                    <div class="col-sm-5 col-xs-6 text-larger">
                        <strong>
                            <?php 
                                $levelAmount = trans("usersmanagement.labelAccessLevel");
                                if($user->level() >=2) {
                                    $levelAmount = trans("usersmanagement.labelAccessLevels");
                                }
                            ?>
                            {{ trans("usersmanagement.labelAccessLevel")}} {{ $levelAmount }}:
                        </strong>
                    </div>
                     <div class="col-sm-7">

              @if($user->level() >= 5)
                <span class="label label-primary margin-half margin-left-0">5</span>
              @endif

              @if($user->level() >= 4)
                 <span class="label label-info margin-half margin-left-0">4</span>
              @endif

              @if($user->level() >= 3)
                <span class="label label-success margin-half margin-left-0">3</span>
              @endif

              @if($user->level() >= 2)
                <span class="label label-warning margin-half margin-left-0">2</span>
              @endif

              @if($user->level() >= 1)
                <span class="label label-default margin-half margin-left-0">1</span>
              @endif

            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
