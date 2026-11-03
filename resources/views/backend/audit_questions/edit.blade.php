@extends('layouts.backend.index')

@section('content')

<div class="card">

<div class="card-body p-4">

<form action="{{ route('admin.audit.questions.update', $question->id) }}" method="POST">

@csrf
@method('PUT')

<input type="hidden" name="id" value="{{ $question->id }}">


{{-- QUESTION --}}
<div class="input-area mb-4">

<label class="form-label">
Question <span class="text-red-500">*</span>
</label>

<input
type="text"
name="question"
class="form-control"
value="{{ old('question',$question->question) }}"
required>

</div>



{{-- OPTIONS --}}
<div class="input-area mb-4">

<label class="form-label">
Options (comma separated)
</label>

<input
type="text"
name="options"
class="form-control"
value="{{ old('options',$question->options) }}"
placeholder="Yes,No,Unknown">

</div>



{{-- RISK ANSWER --}}
<div class="input-area mb-4">

<label class="form-label">
Risk Answer
</label>

<input
type="text"
name="risk_answer"
class="form-control"
value="{{ old('risk_answer',$question->risk_answer) }}">

</div>



{{-- RISK TITLE --}}
<div class="input-area mb-4">

<label class="form-label">
Risk Title
</label>

<input
type="text"
name="risk_title"
class="form-control"
value="{{ old('risk_title',$question->risk_title) }}">

</div>



{{-- RISK DESCRIPTION --}}
<div class="input-area mb-4">

<label class="form-label">
Risk Description
</label>

<textarea
name="risk_description"
class="form-control"
rows="4">{{ old('risk_description',$question->risk_description) }}</textarea>

</div>



{{-- SORT ORDER + STATUS --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

<div class="input-area">

<label class="form-label">
Sort Order
</label>

<input
type="number"
name="sort_order"
class="form-control"
value="{{ old('sort_order',$question->sort_order) }}">

</div>



<div class="input-area">

<label class="form-label">
Status
</label>

<select name="status" class="form-control">

<option value="1"
{{ $question->status == 1 ? 'selected' : '' }}>
Active
</option>

<option value="0"
{{ $question->status == 0 ? 'selected' : '' }}>
Inactive
</option>

</select>

</div>

</div>



<button class="btn btn-dark mt-6">

Update Question

</button>


</form>

</div>

</div>

@endsection