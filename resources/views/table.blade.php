@use('App\Models\Flight')

@extends('layouts.base')
@section('title')
    {{ $component->title }}
@endsection
@section('main')
    {!! $component->about !!}

    <!-- based on: https://tailwindflex.com/@mr-robot/tab-navigation-with-alpine-js -->
    <div
        x-data="{
            openTab: 1,
            activeClasses: 'border-l border-t border-r rounded-t text-yellow-600',
            inactiveClasses: 'text-yellow-500 hover:text-yellow-400'
        }"
        class="p-6">
        <ul class="flex border-b">
            <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1" >
                <a href="#" :class="openTab === 1 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" > Example </a>
            </li>
            <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1" >
                <a href="#" :class="openTab === 2 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" >
                    Source Code
                </a>
            </li>
        </ul>
        <div class="w-full">
            <div x-show="openTab === 1">
                @livewire($component->name)
            </div>
            <div x-show="openTab === 2">
                <x-code :example=$component/>
            </div>
        </div>
    </div>
@endsection
