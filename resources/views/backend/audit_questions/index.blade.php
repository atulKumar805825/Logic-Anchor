@extends('layouts.backend.index')

@section('content')

{{-- Breadcrumb --}}
<div class="mb-5">
    <ul class="flex items-center gap-2 text-sm">
        <li class="text-primary-500">
            <a href="{{ url('/admin/dashboard') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            </a>
        </li>

        <li class="text-slate-400">/</li>

        <li class="text-slate-700 font-medium">
            Audit Questions
        </li>
    </ul>
</div>


<div class="card">

<header class="card-header flex justify-between items-center">

<h4 class="card-title">
Audit Questions
</h4>

<a href="{{ route('admin.audit.questions.create') }}"
class="btn btn-dark">

Add Question

</a>

</header>


<div class="card-body">


{{-- FILTER FORM --}}
<form method="GET" class="mb-4">

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

<div class="fromGroup">

<label class="form-label">
Question
</label>

<input
type="text"
name="question"
value="{{ request('question') }}"
placeholder="Search question"
class="form-control">

</div>



<div class="fromGroup">

<label class="form-label">
Status
</label>

<select name="status" class="form-control">

<option value="">
All
</option>

<option value="1"
{{ request('status') == '1' ? 'selected' : '' }}>
Active
</option>

<option value="0"
{{ request('status') == '0' ? 'selected' : '' }}>
Inactive
</option>

</select>

</div>

</div>


<div class="flex justify-end gap-2 mt-4">

<a href="{{ route('admin.audit.questions.index') }}"
class="btn btn-outline-secondary">

Reset

</a>

<button class="btn btn-dark">
Search
</button>

</div>

</form>



{{-- TABLE --}}
<div class="overflow-x-auto">

<table class="table-auto w-full border">

<thead>

<tr class="bg-slate-100 text-left">

<th class="px-4 py-2 border">#</th>

<th class="px-4 py-2 border">
Question
</th>

<th class="px-4 py-2 border">
Options
</th>

<th class="px-4 py-2 border">
Risk Answer
</th>

<th class="px-4 py-2 border">
Sort
</th>

<th class="px-4 py-2 border">
Status
</th>

<th class="px-4 py-2 border text-right">
Action
</th>

</tr>

</thead>



<tbody>

@forelse($questions as $index => $question)

<tr class="border-b">

<td class="px-4 py-2 border">

{{ $questions->firstItem() + $index }}

</td>


<td class="px-4 py-2 border font-medium">

{{ $question->question }}

</td>


<td class="px-4 py-2 border">

{{ $question->options }}

</td>


<td class="px-4 py-2 border">

{{ $question->risk_answer }}

</td>


<td class="px-4 py-2 border">

{{ $question->sort_order }}

</td>


<td class="px-4 py-2 border">

@if($question->status)

<span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
Active
</span>

@else

<span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">
Inactive
</span>

@endif

</td>


<td class="px-4 py-2 border text-right">

<a href="{{ route('admin.audit.questions.edit',$question->id) }}"
class="btn btn-sm btn-dark">

Edit

</a>


<form action="{{ route('admin.audit.questions.destroy',$question->id) }}"
method="POST"
class="inline-block"
onsubmit="return confirm('Delete this question?')">

@csrf
@method('DELETE')

<button class="btn btn-sm btn-danger">

Delete

</button>

</form>

</td>

</tr>


@empty

<tr>

<td colspan="7"
class="text-center py-6 text-slate-500">

No questions found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>



{{-- PAGINATION --}}
<div class="mt-6">

{{ $questions->links() }}

</div>


</div>
</div>

@endsection