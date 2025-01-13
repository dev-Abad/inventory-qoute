@extends('layouts.app')

@section('content')
    <h1>DRE Computer Center</h1>

    <h3>44 Quezon Ave, Brgy. 2 Lucena city</h3>
    <h3>(beside st. veronica laboratory)</h3>
    <form id="quotationForm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Part Name</th>
                    <th class="quantity-column">Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($selectedParts as $part)
                    <tr>
                        <td>{{ $part['name'] }}</td>
                        <td>
                            <!-- Make the quantity editable -->
                            <input type="number" class="form-control quantity" name="quantity[{{ $part['id'] }}]" value="{{ $part['quantity'] }}" min="1">
                        </td>
                        <td>PHP {{ number_format($part['price'], 2) }}</td>
                        <td>
                            <span class="total-price">PHP {{ number_format($part['total'], 2) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Price (placed in the lower-right corner of the table) -->
        <div class="total-price-container">
            <h3>Total Price: PHP <span id="finalTotal">{{ number_format($totalPrice, 2) }}</span></h3>
        </div>

        <button type="button" id="updateQuotation" class="btn btn-primary" disabled>Update Quotation</button>
    </form>

    <a href="{{ route('quotation.index') }}" class="btn btn-secondary">Back to Quotation</a>

    <script>
        // Function to update the total price dynamically when quantity changes
        function updateTotalPrice() {
            let total = 0;

            $('tbody tr').each(function() {
                let price = parseFloat($(this).find('td:eq(2)').text().replace('PHP ', '').replace(/,/g, ''));
                let quantity = parseInt($(this).find('.quantity').val());
                let totalPrice = price * quantity;

                $(this).find('.total-price').text('PHP ' + totalPrice.toFixed(2));

                total += totalPrice;
            });

            $('#finalTotal').text(total.toFixed(2));
        }

        // Enable the "Update Quotation" button if any quantity changes
        $('#quotationForm').on('input', '.quantity', function() {
            $('#updateQuotation').prop('disabled', false);  // Enable the button
            updateTotalPrice();  // Recalculate the total price
        });

        // Initial calculation on page load
        updateTotalPrice();
    </script>

@endsection

<!-- Custom Style for the Total Price -->
<style>
    /* Style the table and its elements */
    table {
        width: 100%;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    th, td {
        padding: 12px;
        text-align: center;
        font-size: 14px;
    }

    th {
        background-color: #007bff;
        color: #ffffff;
        font-weight: bold;
    }

    td {
        background-color: #f9f9f9;
    }

    .quantity-column {
        width: 10%; /* Make the Quantity column more narrow */
    }

    .quantity {
        width: 80px;
        padding: 5px;
        font-size: 14px;
        text-align: center;
    }

    .total-price {
        font-weight: bold;
        color: #28a745; /* Green for total price */
    }

    #finalTotal {
        font-size: 30px;
        font-weight: bold;
        color: #007bff; /* Blue for the total price display */
    }

    #updateQuotation {
        margin-top: 20px;
    }

    .btn-secondary {
        margin-top: 20px;
    }

    /* Custom container for the total price at the bottom-right corner of the table */
    .total-price-container {
        text-align: right;
        margin-top: 20px;
    }
</style>
