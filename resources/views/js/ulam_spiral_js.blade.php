<script>
    class UlamSpiral {
        constructor() {
            this.go = document.getElementById('go');
            this.usFormatter = new Intl.NumberFormat('en-US');
            this.centerSnapshot = null;

            this.setup();
            this.listen();
        }
        animateSpiral() {
            this.spiral = this.generateUlamSpiral(25000);

            this.currentIndex = 0;
            const speed = 100; // Numbers to draw per frame

            // Dynamically calculate absolute top-left coordinates of the HUD box
            const canvas = this.ctx.canvas;
            const boxX = (canvas.width / 2) - 60;
            const boxY = (canvas.height / 2) - 20;
            this.ctx.clearRect(-315, -315, 630, 630);

            const loop = () => {
                // A. PRIOR FRAME CLEANUP: If we have an old snapshot, put it back
                // to erase the old text before we paint any new spiral dots.
                if (this.centerSnapshot) {
                    this.ctx.putImageData(this.centerSnapshot, boxX, boxY);
                }

                // B. DRAW NEW SPIRAL POINTS FOR THIS FRAME
                const targetEnd = Math.min(this.currentIndex + speed, this.spiral.length);
                for (let i = this.currentIndex; i < targetEnd; i++) {
                    const point = this.spiral[i];
                    this.drawPixel(point.x, point.y, point.isPrime);
                }

                // C. TAKE FRESH SNAPSHOT: Capture the clean, newly drawn dots
                // BEFORE we overlay the text.
                this.centerSnapshot = this.ctx.getImageData(boxX, boxY, 120, 40);

                // D. DRAW OVERLAY TEXT: Stamp the text on top for this frame.
                this.ctx.fillStyle = "rgba(0, 0, 255, 0.7)";
                this.ctx.fillText(this.usFormatter.format(targetEnd), 0, 0);

                // E. NEXT FRAME CONFIGURATION
                this.currentIndex = targetEnd;

                if (this.currentIndex < this.spiral.length) {
                    requestAnimationFrame(loop);
                } else {
                    // OPTIONAL FINAL CLEANUP: Erase the text when completely done
                    // to leave the final canvas pristine.
                    this.ctx.putImageData(this.centerSnapshot, boxX, boxY);
                    this.ctx.fillText(this.usFormatter.format(targetEnd), 0, 0);
                }
            };

            requestAnimationFrame(loop);
        }

        generateUlamSpiral(maxNumber) {
            let points = [];

            // Start at the center of our coordinate system
            let x = 0;
            let y = 0;

            // Movement configuration: Right, Up, Left, Down
            const directions = [
                { dx: 1,  dy: 0 },  // Right
                { dx: 0,  dy: -1 }, // Up (negative Y because screen pixels go down)
                { dx: -1, dy: 0 },  // Left
                { dx: 0,  dy: 1 }   // Down
            ];

            let currentDir = 0; // Start by moving Right
            let stepLength = 1; // How many steps to take in the current direction
            let stepCount = 0;  // Tracks when to increase the step length

            let currentNumber = 1;

            while (currentNumber <= maxNumber) {
                // 1. Take the required number of steps in the current direction
                for (let i = 0; i < stepLength && currentNumber <= maxNumber; i++) {

                    // Record this number's position and whether it's a prime
                    points.push({
                        number: currentNumber,
                        x: x,
                        y: y,
                        isPrime: this.isPrime(currentNumber) // Using our fast prime checker!
                    });

                    // Move to the next coordinate
                    x += directions[currentDir].dx;
                    y += directions[currentDir].dy;
                    currentNumber++;
                }

                // 2. Change direction (cycle through Right -> Up -> Left -> Down)
                currentDir = (currentDir + 1) % 4;

                // 3. Every 2 turns, increase the length of the straight line by 1
                stepCount++;
                if (stepCount % 2 === 0) {
                    stepLength++;
                }
            }

            return points;
        }

        isPrime(n) {
            // 1. Handle the base edge cases immediately
            if (n <= 1) return false;
            if (n <= 3) return true; // 2 and 3 are prime

            // 2. Quickly eliminate all even numbers and multiples of 3
            if (n % 2 === 0 || n % 3 === 0) return false;

            // 3. Set the upper limit to the square root of n
            let limit = Math.sqrt(n);

            // 4. Check numbers around multiples of 6 (i, i + 2)
            // Starting at 5 (which is 6(1) - 1), next is 7 (6(1) + 1)
            for (let i = 5; i <= limit; i += 6) {
                if (n % i === 0 || n % (i + 2) === 0) {
                    return false; // Found a factor, not prime
                }
            }

            return true; // No factors found, it's prime!
        }

        drawPixel(x, y, isPrime) {
            // 1. Lower the scale so thousands of numbers fit on your 800x800 canvas
            const scale = 4;
            let targetX = x * scale;
            let targetY = y * scale;

            if (isPrime) {
                // Draw a distinct square for primes
                this.ctx.fillStyle = "red";
                this.ctx.fillRect(targetX, targetY, 3, 3);
            } else {
                // Optional: Draw a tiny, faint dot for composites so you can see the grid structure,
                // or just leave this blank to let the diagonals truly shine!
                this.ctx.fillStyle = "blue";
                this.ctx.fillRect(targetX, targetY, 1, 1);
            }
        }

        setup() {
            const canvas = document.getElementById('xyCanvas');
            canvas.width = 630;
            canvas.height = 630;

            this.ctx = canvas.getContext('2d');

            // Move the (0,0) origin to the center of the canvas
            this.ctx.translate(canvas.width / 2, canvas.height / 2);
            this.ctx.font = "bold 24px monospace";
            this.ctx.textAlign = "center";
            this.ctx.textBaseline = "middle";
        }

        listen() {
            let self = this;
            this.go.addEventListener('click', function() {
                self.animateSpiral();
            });
        }
    }


    new UlamSpiral();
</script>
