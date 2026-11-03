@extends('auth.layout')
@section('title', 'Clinical AI Questionnaire')

@section('content')

<div class="max-w-3xl mx-auto py-10">

<h2 class="text-2xl font-bold text-center mb-8">
Clinical AI Intake Questionnaire & Registration
</h2>

<form method="POST" action="{{ route('register.post') }}">
@csrf

<!-- QUESTION 1 -->
<div class="mb-6">
<label class="font-semibold">
1. Does your AI provider store data on Australian servers?
</label>

<div class="mt-2 space-x-4">
<label><input type="radio" name="q1" value="Yes"> Yes</label>
<label><input type="radio" name="q1" value="No"> No</label>
<label><input type="radio" name="q1" value="Unknown"> Unknown</label>
</div>
</div>

<!-- QUESTION 2 -->
<div class="mb-6">
<label class="font-semibold">
2. Is explicit consent for AI-Assisted Recording included in intake forms?
</label>

<div class="mt-2 space-x-4">
<label><input type="radio" name="q2" value="Yes"> Yes</label>
<label><input type="radio" name="q2" value="No"> No</label>
</div>
</div>

<!-- QUESTION 3 -->
<div class="mb-6">
<label class="font-semibold">
3. Do doctors manually verify 100% of AI generated notes?
</label>

<div class="mt-2 space-x-4">
<label><input type="radio" name="q3" value="Yes"> Yes</label>
<label><input type="radio" name="q3" value="No"> No</label>
</div>
</div>

<!-- QUESTION 4 -->
<div class="mb-6">
<label class="font-semibold">
4. Are audio recordings deleted within 24 hours?
</label>

<div class="mt-2 space-x-4">
<label><input type="radio" name="q4" value="Yes"> Yes</label>
<label><input type="radio" name="q4" value="No"> No</label>
</div>
</div>

<!-- QUESTION 5 -->
<div class="mb-8">
<label class="font-semibold">
5. Has your Medical Indemnity provider confirmed AI compliance?
</label>

<div class="mt-2 space-x-4">
<label><input type="radio" name="q5" value="Yes"> Yes</label>
<label><input type="radio" name="q5" value="No"> No</label>
</div>
</div>

<hr class="my-8">

<!-- REGISTER FIELDS -->

<div class="mb-4">
<label>Name</label>
<input type="text" name="name" class="form-control w-full" required>
</div>

<div class="mb-4">
<label>Email</label>
<input type="email" name="email" class="form-control w-full" required>
</div>

<div class="mb-4">
<label>Password</label>
<input type="password" name="password" class="form-control w-full" required>
</div>

<div class="mb-6">
<label>Confirm Password</label>
<input type="password" name="password_confirmation" class="form-control w-full" required>
</div>

<button class="btn btn-dark w-full">
Submit Questionnaire
</button>

</form>

</div>

@endsection