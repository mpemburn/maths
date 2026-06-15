class Euler {
    constructor() {
    }

    run(caller) {
        let firstPrime = (1 * 1) - 1 + 41;

        // 1. TEMPORARILY DISABLE NORMAL GRAPH RESET
        let originalSuccess = caller.success;
        caller.success = false;

        // Update the text formula blocks for frame 1
        caller.output(1, -1, firstPrime);

        let n = 2;

        const loop = () => {
            let eulerPrime = (n * n) - n + 41;
            caller.a = 1;
            caller.b = -1;
            caller.c = eulerPrime;

            caller.a_input.value = caller.a;
            caller.b_input.value = caller.b;
            caller.c_input.value = caller.c;

            // Updates formula blocks without triggering graph() reset
            caller.output(caller.a, caller.b, caller.c, false);

            n++;
            if (n <= 40) {
                setTimeout(loop, 200);
            } else {
                // 3. RESTORE NORMAL SOLVER FUNCTIONALITY WHEN ANIMATION ENDS
                caller.success = originalSuccess;
            }
        };

        setTimeout(loop, 200);
    }

}
window.euler = new Euler();
