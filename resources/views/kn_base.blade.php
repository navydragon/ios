@extends('layouts.app')

@section('content')

<div class="" style="padding: 0px; min-height: 93vh;">
<section class="page-header dark page-header-xs">
    <div class="container">
        <div class="session__header">
            <img class="session__img" src="/images/kn-base.png" alt="">
            <h1 class="session__title">База знаний</h1>
        </div>
        <p>все материалы базы знаний сгруппированные по категориям</p>
    </div>
</section>

<div class="container">
    <h3 class="kn-category__title">Категории базы знаний</h3>
    <ul class="kn-category__container">
        @foreach ($categories as $category)
            <li class="kn-category__item">
                <a class="kn-category__item-link" href="/knowledge_base/{{$category->id}}">
                    <img class="kn-category__item-img" src="/images/{{$category->icon}}" alt="">
                    <p class="kn-category__item-name">{{$category->name}}</p>
                    <span class="kn-category__item-count countTo" data-speed="1700">{{$category->materials_count}}</span>
                </a>
            </li>
        @endforeach
        <li class="kn-category__item">
            <a class="kn-category__item-link" href="/knowledge_base/all">
                <img class="kn-category__item-img" src="/images/kn-base-latest.png" alt="">
                <p class="kn-category__item-name">Все материалы</p>
                <span class="kn-category__item-count countTo" data-speed="1700">{{$all_materials_count}}</span>
            </a>
        </li>
    </ul>

    <h3 class="kn-material__title">Последние материалы</h3>
    <ul class="kn-material__container">
        @foreach ($latest_materials as $material)
        <li class="kn-material__item">
            <img class="kn-material__item-img" src="/images/{{$material->category ? $material->category->icon:'default.png'}}" alt="">
            <div class="kn-material__info">
                <span class="kn-material__item-category">{{$material->category->name ?? ""}}</span>
                <h3 class="kn-material__item-name">{{$material->name}}</h3>
                <ul class="kn-material__tags-container">
                    @foreach($material->tags as $tag)
                    <li class="kn-material__tag">{{$tag->tag}}</li>
                    @endforeach
                </ul>
            </div>
            <a href="/knowledge_base/materials/{{$material->id}}" class="kn-material__button">ПОДРОБНЕЕ</a>
        </li>
        @endforeach
    </ul>
</div>

@endsection
