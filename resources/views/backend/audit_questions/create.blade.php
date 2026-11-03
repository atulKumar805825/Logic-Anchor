@extends('layouts.backend.index')

@section('content')

<div class="card">

<div class="card-body p-4">

<form action="{{ route('admin.audit.questions.store') }}" method="POST">

@csrf

<input type="hidden" name="id" value="{{ $model->id ?? '' }}">


{{-- QUESTION --}}
<div class="input-area mb-4">

<label class="form-label">
Question <span class="text-red-500">*</span>
</label>

<input
type="text"
name="question"
class="form-control"
value="{{ old('question',$model->question ?? '') }}"
placeholder="Enter audit question"
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
value="{{ old('options',$model->options ?? '') }}"
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
value="{{ old('risk_answer',$model->risk_answer ?? '') }}"
placeholder="Example: No">

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
value="{{ old('risk_title',$model->risk_title ?? '') }}"
placeholder="Example: Data Storage Compliance Risk">

</div>



{{-- RISK DESCRIPTION --}}
<div class="input-area mb-4">

<label class="form-label">
Risk Description
</label>

<textarea
name="risk_description"
class="form-control"
rows="4"
placeholder="Explain the compliance risk">

{{ old('risk_description',$model->risk_description ?? '') }}

</textarea>

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
value="{{ old('sort_order',$model->sort_order ?? 0) }}">

</div>



<div class="input-area">

<label class="form-label">
Status
</label>

<select name="status" class="form-control">

<option value="1"
{{ old('status',$model->status ?? 1) == 1 ? 'selected' : '' }}>
Active
</option>

<option value="0"
{{ old('status',$model->status ?? 1) == 0 ? 'selected' : '' }}>
Inactive
</option>

</select>

</div>

</div>



<button class="btn btn-dark mt-6">

{{ isset($model->id) ? 'Update Question' : 'Create Question' }}

</button>


</form>

</div>

</div>

@endsection