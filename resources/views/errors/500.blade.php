@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')


@php
$message = ($exception->getMessage() == null ? __('Server Error') : $exception->getMessage());
@endphp

@section('message', $message)
