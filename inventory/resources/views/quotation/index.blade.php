@extends('layouts.app')

@section('content')
    <h1>Create Quotation</h1>

    <form id="quotationForm" action="{{ route('quotation.generate') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Column 1 with product selections -->
            <div class="col-md-6">
                @foreach (['processor', 'ram', 'hdd', 'fan', 'monitor'] as $productType)
                    <div class="mb-3">
                        <label for="{{ $productType }}" class="form-label">{{ ucfirst($productType) }}</label>
                        <select name="products[{{ $loop->index }}]" id="{{ $productType }}" class="form-select">
                            <option value="">Select {{ ucfirst($productType) }}</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>

            <!-- Column 2 with additional selections -->
            <div class="col-md-6">
                @foreach (['motherboard', 'ssd', 'gpu', 'aio', 'casing', 'kb_mouse'] as $productType)
                    <div class="mb-3">
                        <label for="{{ $productType }}" class="form-label">{{ ucfirst($productType) }}</label>
                        <select name="products[{{ $loop->index + 5 }}]" id="{{ $productType }}" class="form-select">
                            <option value="">Select {{ ucfirst($productType) }}</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Generate Quotation</button>
    </form>

    <script>
        // Calculate total price and selected parts dynamically
        $('#quotationForm').on('change', 'select', function() {
            let total = 0;
            let partsList = [];

            $('select').each(function() {
                let selectedOption = $(this).find(':selected');
                let partName = selectedOption.text();
                let price = selectedOption.data('price');

                if (partName && price) {
                    total += price;
                    partsList.push({ name: partName, price: price });
                }
            });

            // Update the total price
            $('#finalPrice').text(total.toFixed(2));
        });
    </script>
@endsection
