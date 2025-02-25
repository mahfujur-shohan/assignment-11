@extends('layouts.app')

@section('title', 'Add Product')

@section('breadcump-title', 'Add Product')

@push('styles')
    
<style>
    /* Basic form styling */
    #multiStepForm {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
    }

    .step {
        display: none;
    }

    .step.active {
        display: block;
    }

    input, textarea, select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        padding: 10px 20px;
        margin: 10px 5px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    button[type="button"].prev-step {
        background-color: #6c757d;
    }

    button[type="button"].prev-step:hover {
        background-color: #5a6268;
    }

    #progress {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }
</style>

@endpush

@section('content')
    

<form id="multiStepForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="progress">
        Step <span id="current-step">1</span> of <span id="total-steps">3</span>
    </div>

    <!-- Step 1: Product Details -->
    <div class="step active" data-step="1">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="category" placeholder="Category" required>
        <input type="number" name="price" placeholder="Price" required>
        <button type="button" class="next-step">Next</button>
    </div>

    <!-- Step 2: Product Description -->
    <div class="step" data-step="2">
        <textarea name="short_description" placeholder="Short Description" required></textarea>
        <textarea name="long_description" placeholder="Long Description" required></textarea>
        <input type="file" name="image">
        <button type="button" class="prev-step">Previous</button>
        <button type="button" class="next-step">Next</button>
    </div>

    <!-- Step 3: Additional Details -->
    <div class="step" data-step="3">
        <input type="number" name="stock" placeholder="Stock" required>
        <select name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <textarea name="seo_tags" placeholder="SEO Tags"></textarea>
        <button type="button" class="prev-step">Previous</button>
        <button type="submit">Submit</button>
    </div>
</form>


@endsection

@push('scripts')
    
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('multiStepForm');
        const steps = Array.from(form.querySelectorAll('.step'));
        const currentStepDisplay = document.getElementById('current-step');
        const totalStepsDisplay = document.getElementById('total-steps');
        let currentStep = 0;

        // Show the first step
        steps[currentStep].classList.add('active');
        totalStepsDisplay.textContent = steps.length;
        currentStepDisplay.textContent = currentStep + 1;

        // Next button functionality
        form.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', () => {
                if (currentStep < steps.length - 1) {
                    steps[currentStep].classList.remove('active');
                    currentStep++;
                    steps[currentStep].classList.add('active');
                    currentStepDisplay.textContent = currentStep + 1;
                }
            });
        });

        // Previous button functionality
        form.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', () => {
                if (currentStep > 0) {
                    steps[currentStep].classList.remove('active');
                    currentStep--;
                    steps[currentStep].classList.add('active');
                    currentStepDisplay.textContent = currentStep + 1;
                }
            });
        });
    });
</script>

@endpush