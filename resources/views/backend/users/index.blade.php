@extends('layouts.backend.index')
@section('content')
<style>
    tr {
        text-align: left;
    }
    
   
    .btn-info {
    --tw-bg-opacity: 1;
    background-color: rgb(0, 127, 128) !important;
    --tw-text-opacity: 1;
    color: rgb(255 255 255 / var(--tw-text-opacity));
    --tw-ring-opacity: 1;
    --tw-ring-color: rgb(0, 127, 128) !important;
}
   
</style>
<div class="mb-5">
    <ul class="flex items-center gap-2 text-sm">
        <li class="text-primary-500">
            <a href="{{ url('/admin/dashboard') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            </a>
        </li>
        <li class="text-slate-400">/</li>
        <li class="text-slate-700 font-medium">Users</li>
    </ul>
</div>

<div class="card">

<div class="card-header flex justify-between items-center">
<h4 class="card-title">Users</h4>
</div>

<div class="card-body">

{{-- SEARCH --}}
<form method="GET" class="mb-4">

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

<div>
<label class="form-label">Search User</label>

<input type="text"
name="search"
value="{{ request('search') }}"
placeholder="Search name, email ..."
class="form-control">

</div>

</div>

<div class="flex justify-end gap-2 mt-4">

<a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
Reset
</a>

<button class="btn btn-dark">
Search
</button>

</div>

</form>


{{-- USERS TABLE --}}
<div class="overflow-x-auto">

<table class="table-auto w-full border">

<thead class="bg-gray-100">
<tr>
    <th class="px-4 py-2 border">#</th>
    <th class="px-4 py-2 border">Name</th>
    <th class="px-4 py-2 border">Email</th>
    <!--<th class="px-4 py-2 border">Phone</th>-->
    <th class="px-4 py-2 border">Created</th>
    <!--<th class="px-4 py-2 border">Questionnaire Status</th> <!-- NEW -->
    <th class="px-4 py-2 border">Actions</th>
</tr>
</thead>

<tbody>
@forelse($users as $index => $user)
<tr class="border-b">
    <td class="px-4 py-2">
        {{ $users->firstItem() + $index }}
    </td>

    <td class="px-4 py-2 font-medium">
        {{ $user->name ?? '—' }}
    </td>

    <td class="px-4 py-2">
        {{ $user->email ?? '—' }}
    </td>

    <!--<td class="px-4 py-2">-->
    <!--    {{ $user->phone ?? '—' }}-->
    <!--</td>-->

    <td class="px-4 py-2">
        {{ $user->created_at?->format('d M Y') }}
    </td>

    <!-- QUESTIONNAIRE STATUS -->
<!--    <td class="px-4 py-2">-->
<!--    @if($user->questionnaire)-->
<!--        @php $status = $user->questionnaire->status; @endphp-->

<!--        @if($status == 'initial_audit')-->
<!--            <span class="inline-block px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-full">-->
<!--                Initial Audit-->
<!--            </span>-->
<!--        @elseif($status == 'logic_stress_test')-->
<!--            <span class="inline-block px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">-->
<!--                Stress Test-->
<!--            </span>-->
<!--        @elseif($status == 'governance_certified')-->
<!--            <span class="inline-block px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">-->
<!--                Certified-->
<!--            </span>-->
<!--        @elseif($status == 'rejected')-->
<!--            <span class="inline-block px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">-->
<!--                Rejected-->
<!--            </span>-->
<!--        @else-->
<!--            <span class="inline-block px-3 py-1 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full">-->
<!--                {{ ucfirst($status) }}-->
<!--            </span>-->
<!--        @endif-->
<!--    @else-->
<!--        <span class="inline-block px-3 py-1 text-sm font-semibold text-gray-500 bg-gray-100 rounded-full">-->
<!--            No Questionnaire-->
<!--        </span>-->
<!--    @endif-->
<!--</td>-->

    <td class="px-4 py-2">
        <div class="flex gap-2">
            <a href="{{ route('admin.users.view',$user->id) }}"
               class="btn btn-sm btn-info">
               View
            </a>

            <!--<form action="{{ route('admin.users.delete',$user->id) }}"-->
            <!--      method="POST"-->
            <!--      onsubmit="return confirm('Delete this user?')">-->
            <!--    @csrf-->
            <!--    @method('DELETE')-->
            <!--    <button class="btn btn-sm btn-danger">Delete</button>-->
            <!--</form>-->
        </div>
    </td>
</tr>
@empty
<tr>
<td colspan="7" class="text-center py-4">
No users found
</td>
</tr>
@endforelse
</tbody>
</table>

</div>


{{-- PAGINATION --}}
<div class="mt-6">
{{ $users->links() }}
</div>

</div>

</div>

@endsection