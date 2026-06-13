<script>
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
                let realPart = (-b / this.divisor).toFixed(2);
                let imaginaryPart = (Math.sqrt(-this.discriminant) / this.divisor).toFixed(2);

                // Return the two complex conjugate roots as strings
                let root1 = `${realPart} + ${imaginaryPart}i`;
                let root2 = `${realPart} - ${imaginaryPart}i`;

                return [root1, root2];
            }

            // Handle Real Roots (Discriminant >= 0)
            let root1 = (-b + Math.sqrt(this.discriminant)) / this.divisor;
            let root2 = (-b - Math.sqrt(this.discriminant)) / this.divisor;

            return [root1.toFixed(2), root2.toFixed(2)];
        }

        showFormulas() {
            this.formulaBlock.style.display = (this.success) ? 'block' : 'none';
            // Intermediate
            this.a_value[0].innerHTML = this.a;
            this.a_value[1].innerHTML = this.a;
            this.b_value[0].innerHTML = this.b;
            this.b_value[1].innerHTML = this.b;
            this.c_value[0].innerHTML = this.c;

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
            if (window.resultsChart) {
                window.resultsChart.destroy();
            }

            if (!this.success) {
                return;
            }

            window.resultsChart = new Chart(this.chart, {
                type: 'line',
                data: {
                    datasets: [{
                        label: `y = ${a}x² + ${b}x + ${c}`,
                        data: this.points,
                        pointRadius: 0,
                        borderWidth: 2,
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'linear',
                            position: 'center',
                            min: -15,
                            max: 15
                        },
                        y: {
                            type: 'linear',
                            position: 'center',
                            min: -100,
                            max: 100
                        }
                    }
                }
            });
        }

        output() {
            this.outputBlock.style.display = 'block';
            this.resultsBlock.innerHTML = '';
            this.result.forEach((line, index) => {
                this.resultsBlock.innerHTML += (line + '<br>');
            });
            // Clear for next results
            this.result = [];
            this.showFormulas();
            this.graph(this.a, this.b, this.c);
        }

        setVariables() {
            this.elements = [
                'go',
                'outputBlock',
                'resultsBlock',
                'formulaBlock',
                'chartBlock',
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
                self.a = Number(document.getElementById('a').value);
                self.b = Number(document.getElementById('b').value);
                self.c = Number(document.getElementById('c').value);
                self.result = self.solve(self.a, self.b, self.c);
                self.output(self.a, self.b, self.c);
            });
        }

    }
    new Quadratic();
</script>
