<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    @assets
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @vite(['resources/js/linechart.js', 'resources/js/euler.js', 'resources/js/quadratic.js']);
    @endassets
    <div id="block">
        <h1>Quadratic Equation Solver</h1>
        <div>Enter a, b, and c values and click "GO"</div>
        <div id="inputs">
            <math>
                <mi>y</mi>
                <mo>=</mo>
                <mi><input type="number" class="form-input red-text" id="a_input" placeholder="a"/></mi>
                <msup>
                    <mrow>
                        <mi class="padded">x</mi>
                    </mrow>
                    <mn>2</mn>
                </msup>
                <mo>+</mo>
                <mi><input type="number" class="form-input blue-text" id="b_input" placeholder="b"/></mi>
                <mi class="padded">x</mi>
                <mo>+</mo>
                <mi><input type="number" class="form-input green-text" id="c_input" placeholder="c"/></mi>
                mi>
            </math>
            <button id="go" class="form-input">GO</button>
        </div>
        <div id="error"></div>
        <button id="euler" class="form-input">Euler</button>

        <div id="outputBlock">
            <div id="formulaBlock">
                Formulae:
                <div class="w-full max-w-6xl mx-auto p-6">
                    <div class="maths-grid">
                        <div class="maths-card">
                            @include('parts.raw_equation')
                        </div>

                        <div class="maths-card">
                            @include('parts.intermediate_equation')
                        </div>

                        <div class="maths-card">
                            @include('parts.result_equation')
                        </div>
                    </div>
                </div>
            </div>
            <div id="chartBlock" class="w-full max-w-6xl mx-auto p-6">
                <canvas id="quadCanvas"></canvas>
            </div>
        </div>
    </div>
</div>
@script

@endscript
