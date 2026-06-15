class Quadratic {
    constructor() {
        this.result = [];
        this.a = 0;
        this.b = 0;
        this.c = 0;
        this.discriminant = 0;
        this.divisor = 0;
        this.inverseB = 0;
        this.success = false;
        this.setVariables();
        this.listen();
    }

    solve(a, b, c) {
        this.success = true;
        this.error.innerHTML = '';
        this.divisor = (2 * a);

        if (a === 0) {
            this.success = false;
            this.error.innerHTML = 'Not a quadratic equation (a cannot be 0)';
            return [];
        }

        this.discriminant = (b * b) - (4 * a * c);
        this.inverseB = (b * -1);

        // Handle Complex (Imaginary) Roots
        if (this.discriminant < 0) {
            let realPart = (-b / this.divisor).toFixed(3);
            let imaginaryPart = (Math.sqrt(-this.discriminant) / this.divisor).toFixed(8);

            // Return the two complex conjugate roots as strings
            let root1 = `${realPart} + ${imaginaryPart}i`;
            let root2 = `${realPart} - ${imaginaryPart}i`;

            return [root1, root2];
        }

        // Handle Real Roots (Discriminant >= 0)
        let root1 = (-b + Math.sqrt(this.discriminant)) / this.divisor;
        let root2 = (-b - Math.sqrt(this.discriminant)) / this.divisor;

        return [root1.toFixed(8), root2.toFixed(8)];
    }

    showFormulas(a, b, c) {
        this.formulaBlock.style.display = (this.success) ? 'block' : 'none';
        // Intermediate
        this.a_value[0].innerHTML = a;
        this.a_value[1].innerHTML = a;
        this.b_value[0].innerHTML = b;
        this.b_value[1].innerHTML = b;
        this.c_value[0].innerHTML = c;

        // Results
        this.inv.innerHTML = this.inverseB;
        this.dis.innerHTML = this.discriminant;
        this.div.innerHTML = this.divisor;
    }

    graph(a, b, c) {
        this.points = [];

        for (let x = -15; x <= 15; x += 0.5) {
            let y = (a * x * x) + (b * x) + c;
            this.points.push({x: x, y: y});
        }
        // Kill the old canvas instance cleanly
        if (window.lineChart.chart) {
            window.lineChart.chart.destroy();
        }

        if (!this.success) {
            return;
        }
        window.lineChart.setCanvas(this.quadCanvas);
        window.lineChart.create(`y = ${a}x² + ${b}x + ${c}`, this.points);
    }

    output(a, b, c, showGraph) {
        let result = this.solve(a, b, c);

        this.outputBlock.style.display = 'block';
        this.resultsBlock.innerHTML = '';
        result.forEach((line, index) => {
            this.resultsBlock.innerHTML += (line + '<br>');
        });

        this.showFormulas(a, b, c);
        this.chartBlock.style.display = showGraph ? 'block' : 'none';
        if (showGraph) {
            this.graph(a, b, c);
        }
    }

    setVariables() {
        this.elements = [
            'a_input',
            'b_input',
            'c_input',
            'go',
            'euler',
            'outputBlock',
            'resultsBlock',
            'formulaBlock',
            'chartBlock',
            'quadCanvas',
            'error',
            'formula',
            'chart',
            'inv',
            'dis',
            'div'
        ];
        this.classes = [
            'a-value',
            'b-value',
            'c-value',
        ];

        this.elements.forEach((variable, index) => {
            this[variable] = document.getElementById(variable);
        });

        this.classes.forEach((className, index) => {
            this[className.replace('-', '_')] = document.getElementsByClassName(className);
        });
    }

    listen() {
        let self = this;
        this.go.addEventListener('click', function() {
            let a = Number(self.a_input.value);
            let b = Number(self.b_input.value);
            let c = Number(self.c_input.value);
            self.output(a, b, c, true);
        });

        this.euler.addEventListener('click', function() {
            window.euler.run(self);
        });
    }

}

new Quadratic();
