@extends('layouts.admin')

@section('categories-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-face'></i>
    <span class="nav-label">Categorias</span>
</div>
@endsection

@section('content')
<div class="card-container">
    <div class="flex-container flex-vertical" style="height: 100%;">
        <div class="flex-container flex-spaced flex-aligned-center">
            <h1 class="welcome-title">Categorias</h1>

            <input type="text" id="filter" class="search-input" name="search-category" placeholder="Inserte una categoría...">
        </div>

        <form action="{{ route('category.delete') }}" method="POST" style="height: 80%;">
            @csrf
            <ul id="category-box" class="background-outline">
                @foreach($categorys as $category)
                <li class="flex-container flex-aligned-center checkbox-container">
                    <div class="checkbox path">
                        <input id="{{$category->category}}-checkbox" type="checkbox" name="category" value="{{$category->id}}">
                        <svg viewBox="0 0 21 21">
                            <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                        </svg>
                    </div>

                    <label for="{{$category->category}}-checkbox">{{$category->category}}</label>
                </li>
                @endforeach
                <div id="addCategory" class="flex-container flex-center flex-aligned-center">
                    <span>La categoría no existe, <a href="{{ route('category.create') }}"></a></span>
                </div>
            </ul>

            <div class="flex-container flex-end">
                <button type="submit" class="edit-btn">
                    <i class='bx bx-trash'></i>
                    ELIMINAR CATEGORIAS
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripting')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#addCategory').hide();

        $("#filter").keyup(function() {
            let count = 0;
            // Loop through the comment list
            $("#category-box li").each(function() {
                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp($(filter).val(), "i")) < 0) {
                    $(this).fadeOut();
                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).fadeIn();
                    count++;
                }
            });

            if (count == 0) {
                $('#addCategory span a').text("crear la categoría " + $(filter).val());

                $('#addCategory').fadeIn();
            } else {
                $('#addCategory').fadeOut();
            }
        });
    });
</script>
@endsection