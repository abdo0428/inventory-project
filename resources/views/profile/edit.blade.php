@extends('layouts.app')

@section('content')
@php($breadcrumbs = [['title' => __('ui.profile'), 'url' => route('profile.edit')]])

<section class="profile-hero mb-4">
    <div class="profile-hero-copy">
        <h1 class="h4 mb-1">{{ __('ui.profile_heading') }}</h1>
        <p class="text-muted mb-0">{{ __('ui.profile_intro') }}</p>
    </div>
</section>

<div class="row g-4">
    <div class="col-12"><div class="panel profile-panel">@include('profile.partials.update-profile-information-form')</div></div>
    <div class="col-12"><div class="panel profile-panel">@include('profile.partials.update-password-form')</div></div>
    <div class="col-12"><div class="panel profile-panel profile-panel-danger">@include('profile.partials.delete-user-form')</div></div>
</div>
@endsection
