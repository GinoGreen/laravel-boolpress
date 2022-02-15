@extends('layouts.admin')

@section('content')
   <div class="container">
      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
         @foreach ($errors->all()
          as $error)
            <li>{{ $error }}</li>
         @endforeach
      </div>
      @endif
      <h1>Modifica Post</h1>
      <form action="{{ route('admin.post.update', $post) }}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('PUT')
         <div class="mb-3">
            <label class="form-check-label" for="title">Titolo</label>
            <input 
               type="text" 
               placeholder="Inserisci il titolo del post"
               id="title"
               name="title"
               value="{{ old('title', $post->title) }}"
               class="form-control
                  @error('title')
                     is-invalid
                  @enderror
               "
            >
            @error('title')   
               <p class="@error('title')
                  invalid-feedback
               @enderror">{{ $message }}</p>
            @enderror
         </div>
         <div class="mb-3">
            @if ($post->cover)
               <div>
                  <img width="250px" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->cover_original_name }}">
               </div>
            @endif
            <label class="form-check-label" for="cover">Immagine</label>
            <input 
               type="file" 
               placeholder="Inserisci il titolo del post"
               id="cover"
               name="cover"
               class="form-control
                  @error('cover')
                     is-invalid
                  @enderror
               "
            >
            @error('cover')   
               <p class="@error('cover')
                  invalid-feedback
               @enderror">{{ $message }}</p>
            @enderror
         </div>
         <div class="mb-3">
            <label class="form-check-label" for="category_id">Categoria</label>
            <select class="form-control mb-3" name="category_id">
               <option value="">Seleziona la categoria</option>
               @foreach ($categories as $category)
                  <option value="{{ $category->id }}"
                     @if ($category->id == old('category_id', $post->category_id))
                        selected
                     @endif   
                  >{{ $category->name }}</option>
               @endforeach
            </select>
         </div>
         <div class="mb-3 form-check">
            @foreach ($tags as $tag)
               <input type="checkbox"
                  class="form-check-input"
                  id="tag{{ $loop->iteration }}"
                  name="tags[]"
                  value="{{ $tag->id }}"

                  @if (!$errors->any() && $post->tags->contains($tag->id))
                     checked
                  @elseif ($errors->any() && in_array($tag->id, old('tags', [])))
                     checked
                  @endif
               >
               <label class="form-check-label mr-5"
                  for="tag{{ $loop->iteration }}"
               >{{ $tag->name }}</label>
            @endforeach
         </div>
         <div class="mb-3">
            <label class="form-check-label" for="content">Contenuto</label>
            <textarea
               name="content"
               cols="30"
               rows="10"
               placeholder="Inserisci il contentuto del post"
               id="content"
               class="form-control
                  @error('content')
                     is-invalid
                  @enderror
               "
            >{{ old('content', $post->content) }}</textarea>
            @error('content')   
               <p class="@error('content')
                  invalid-feedback
               @enderror">{{ $message }}</p>
            @enderror
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
      </form>
   </div>
@endsection

@section('title')
   Crea Post
@endsection