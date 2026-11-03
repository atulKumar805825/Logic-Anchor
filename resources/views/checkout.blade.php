<form method="POST" action="{{ route('wise.checkout') }}">
@csrf

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="number" name="amount" placeholder="Amount" required>

<button type="submit">Pay with Wise</button>

</form>