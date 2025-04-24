(function () {
    if (window.NyrixEnergyBallLoaded) return;
    window.NyrixEnergyBallLoaded = true;

    const canvas = document.getElementById("nyrix-energy-canvas");
    if (!canvas) return;

    const ctx = canvas.getContext("2d");
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    let isSpeaking = false;
    window.NyrixEnergyPosition = { x: null, y: null };
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2 -80;

    const layers = [
        { pulse: 0, direction: 1, base: 120, max: 90, speed: 2, alpha: 0.85, color: 'rgba(255, 105, 180,' }, // pink
        { pulse: 0, direction: 1, base: 70, max: 80, speed: 1.8, alpha: 0.85, color: 'rgba(160, 100, 255,' }, // purple
        { pulse: 0, direction: 1, base: 50, max: 40, speed: 2.2, alpha: 0.80, color: 'rgba(100, 200, 255,' }, // blue
    ];
    

    const ambientParticles = Array.from({ length: 40 }, () => createAmbientParticle());
    const swirlParticlesPink = Array.from({ length: 60 }, () => createSwirlParticle(1));
    const swirlParticlesBlue = Array.from({ length: 60 }, () => createSwirlParticle(-1));

    function createAmbientParticle() {
        const r = Math.random() * canvas.width / 2;
        const a = Math.random() * 2 * Math.PI;
        return {
            x: centerX + r * Math.cos(a),
            y: centerY + r * Math.sin(a),
            radius: Math.random() * 3 + 1,
            alpha: Math.random() * 0.2 + 0.05,
            dx: (Math.random() - 0.5) * 0.2,
            dy: (Math.random() - 0.5) * 0.2,
        };
    }

    function createSwirlParticle(direction = 1) {
        const angle = Math.random() * Math.PI * 2;
        return {
            angle,
            direction,
            speed: 0.01 + Math.random() * 0.01,
            distance: 40 + Math.random() * 60,
            size: Math.random() * 2 + 0.5,
            alpha: Math.random() * 0.3 + 0.2,
        };
    }

    // const bgImage = new Image();
    // bgImage.src = '/images/nyrix-bg.jpg'; // Make sure this is correct
    // let bgLoaded = false;
    
    // bgImage.onload = function () {
    //     bgLoaded = true;
    //     console.log("✅ Nyrix background loaded");
    // };
    
    // bgImage.onerror = function () {
    //     console.error("❌ Failed to load Nyrix background image.");
    // };

    function drawEnergyBall() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Add motion blur trail
        ctx.fillStyle = 'rgba(0, 0, 0, 0.2)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Background gradient
        if (bgLoaded) {
            ctx.drawImage(bgImage, 0, 0, canvas.width, canvas.height);
        } else {
            // Optional fallback while image is loading
            ctx.fillStyle = "#000";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        }

        // Ambient particles
        ambientParticles.forEach(p => {
            p.x += p.dx;
            p.y += p.dy;
            if (p.x < 0 || p.x > canvas.width || p.y < 0 || p.y > canvas.height) Object.assign(p, createAmbientParticle());
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, 2 * Math.PI);
            ctx.fillStyle = `rgba(200, 100, 255, ${p.alpha})`;
            ctx.fill();
        });

        // Pink swirl
        swirlParticlesPink.forEach(p => {
            p.angle += p.speed * p.direction;
            const x = centerX + Math.cos(p.angle) * p.distance;
            const y = centerY + Math.sin(p.angle) * p.distance;
            ctx.beginPath();
            ctx.arc(x, y, p.size, 0, 2 * Math.PI);
            ctx.fillStyle = `rgba(255, 105, 180, ${p.alpha})`;
            ctx.fill();
        });

        // Blue swirl
        swirlParticlesBlue.forEach(p => {
            p.angle += p.speed * p.direction;
            const x = centerX + Math.cos(p.angle) * p.distance;
            const y = centerY + Math.sin(p.angle) * p.distance;
            ctx.beginPath();
            ctx.arc(x, y, p.size, 0, 2 * Math.PI);
            ctx.fillStyle = `rgba(100, 200, 255, ${p.alpha})`;
            ctx.fill();
        });

        // Glowing pulse layers
        layers.forEach(layer => {
            const radius = layer.base + layer.pulse + Math.sin(Date.now() / 300 + layer.speed) * 2;

            const gradient = ctx.createRadialGradient(centerX, centerY, 20, centerX, centerY, radius);
            gradient.addColorStop(0, `${layer.color}${layer.alpha})`);
            gradient.addColorStop(1, "rgba(0, 0, 0, 0)");
        
            ctx.fillStyle = gradient;
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
            ctx.fill();
        
            const flicker = (Math.random() * layer.speed) + 0.3;
        
            if (isSpeaking) {
                layer.pulse += layer.direction * flicker;
                if (layer.pulse > layer.max || layer.pulse < -5) layer.direction *= -1;
                if (Math.random() < 0.03) layer.direction *= -1;
            } else {
                // Smoothly return to zero when idle
                layer.pulse += (0 - layer.pulse) * 0.08;
            }
        });

        requestAnimationFrame(drawEnergyBall);
    }

    window.startNyrixPulse = () => isSpeaking = true;
    window.stopNyrixPulse = () => isSpeaking = false;

    drawEnergyBall();
})();

