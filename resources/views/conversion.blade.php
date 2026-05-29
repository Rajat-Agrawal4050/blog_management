<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="convertForm">
    @csrf
    <input type="number" name="amount" placeholder="Enter INR amount" />

    <select name="currency">
        @foreach ($currencies as $currency)
            <option value="{{ $currency }}">{{ $currency }}</option>
        @endforeach
    </select>

    <button type="submit">Convert</button>
</form>

<div id="result"></div>

<script>
    document.getElementById('convertForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        const res = await fetch('/currency/convert', {
            method: 'POST',
            body: formData,
        });

        const data = await res.json();

        document.getElementById('result').innerText = data.success
            ? `${data.from_amount} INR = ${data.result} ${data.to_currency}`
            : data.message;
    });
</script>
</body>
</html>