<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div id="block">
    <h1>Ulam Spiral</h1>
    <div class="w-full max-w-4xl mx-auto p-4 spiral-container">

        <div class="maths-card">
            <div style="margin-bottom: 0.5rem;">
                <button id="go" class="form-input">GO</button>
            </div>
            <canvas id="xyCanvas"></canvas>
        </div>

        <div class="maths-card">
            <p>The Ulam Spiral, or "prime spiral", is a famous mathematical doodle discovered in 1963 by mathematician Stanisław Ulam. While sitting in a boring scientific lecture, he began arranging integers in a square spiral (starting with 1 in the center) and circled the prime numbers. In this version, the prime numbers are represented by small red squares.</p>
            <p>To his surprise, the prime numbers did not appear randomly. Instead, they grouped together along distinct, prominent diagonal lines, forming highly organized patterns.</p>
            <p>These visual lines occur because numbers that share common divisors naturally stack in predictable geometric ways, revealing hidden algebraic equations. For example, a single diagonal line can be heavily driven by quadratic equations (such as
                <math display="inline">
                    <mi>f</mi>
                    <mo>(</mo>
                    <mi>n</mi>
                    <mo>)</mo>
                    <mo>=</mo>
                    <msup>
                        <mi>n</mi>
                        <mn>2</mn>
                    </msup>
                    <mo>&#x2212;</mo>
                    <mi>n</mi>
                    <mo>+</mo>
                    <mn>41</mn>
                </math>, first noted by Leonhard Euler) that are notorious for generating long strings of prime numbers.</p>
            <p>Click the <strong>GO</strong> button to see the Ulam Spiral generated for 25,000 integers.</p>
        </div>

    </div>
</div>
@script
@include('js.ulam_spiral_js')
@endscript
