(function () {
    const canvas = document.getElementById("nyrix-energy-canvas");
    const ctx = canvas?.getContext("2d");
    const video = document.getElementById("nyrix-video");
    if (!canvas || !ctx || !video) return;

    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    let isSpeaking = false;
    window.startNyrixPulse = () => isSpeaking = true;
    window.stopNyrixPulse = () => isSpeaking = false;

    const videoIndex = 1; // Choose a specific video file here
    video.src = `/videos/nyrix/nyrix-${videoIndex}.mp4`;
    video.play().catch(err => console.warn("▶️ Video failed to start:", err));

    // 💠 Energy Layers
    const layers = [
        { pulse: 0, direction: 1, base: 90, max: 95, speed: 3, alpha: 0.65, color: 'rgba(255, 7, 246,' },
        { pulse: 0, direction: 1, base: 70, max: 80, speed: 2.8, alpha: 0.55, color: 'rgba(7, 211, 255,' },
        { pulse: 0, direction: 1, base: 30, max: 40, speed: 3.2, alpha: 0.30, color: 'rgba(173, 27, 209,' },
    ];

    const ambientParticles = Array.from({ length: 40 }, () => createAmbientParticle());
    const swirlParticlesPink = Array.from({ length: 60 }, () => createSwirlParticle(1));
    const swirlParticlesBlue = Array.from({ length: 60 }, () => createSwirlParticle(-1));

    function createAmbientParticle() {
        const r = Math.random() * canvas.width / 2;
        const a = Math.random() * 2 * Math.PI;
        const cx = canvas.width / 2;
        const cy = canvas.height / 2 - 80;
        return {
            x: cx + r * Math.cos(a),
            y: cy + r * Math.sin(a),
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

    const electricArcs = [];

    function createElectricArc() {
        const angle = Math.random() * Math.PI * 2;
        const radius = 60 + Math.random() * 40;
        const arc = {
            points: [],
            alpha: 0.8,
            lifetime: 12 + Math.floor(Math.random() * 10),
        };
    
        const cx = canvas.width / 2;
        const cy = canvas.height / 2 - 60;
    
        const startX = cx + Math.cos(angle) * radius;
        const startY = cy + Math.sin(angle) * radius;
    
        const steps = 5 + Math.floor(Math.random() * 3);
        const stepLength = 10;
        let x = startX, y = startY;
    
        for (let i = 0; i < steps; i++) {
            const dx = (Math.random() - 0.5) * stepLength;
            const dy = (Math.random() - 0.5) * stepLength;
            arc.points.push({ x, y });
            x += dx;
            y += dy;
        }
    
        return arc;
    }

    let smoothedX = canvas.width / 2;
    let smoothedY = canvas.height / 2;

    function trackPurpleForeheadLight() {
        try {
            const tmpCanvas = document.createElement("canvas");
            tmpCanvas.width = canvas.width;
            tmpCanvas.height = canvas.height;
            const tmpCtx = tmpCanvas.getContext("2d");
            tmpCtx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const frame = tmpCtx.getImageData(0, 0, canvas.width, canvas.height).data;
    
            // Forehead region (adjust if needed)
            const regionWidth = canvas.width * 0.5;
            const regionHeight = canvas.height * 0.5;
            const offsetX = canvas.width * 0.25;
            const offsetY = canvas.height * 0.05;
            
            let totalBrightness = 0, sumX = 0, sumY = 0;
            
            for (let y = offsetY; y < offsetY + regionHeight; y++) {
                for (let x = offsetX; x < offsetX + regionWidth; x++) {
                    const i = (Math.floor(y) * canvas.width + Math.floor(x)) * 4;
                    const r = frame[i];
                    const g = frame[i + 1];
                    const b = frame[i + 2];
                    const brightness = r + g + b;
            
                    if (brightness > 600) {
                        sumX += x * brightness;
                        sumY += y * brightness;
                        totalBrightness += brightness;
                    }
                }
            }
    
            let targetX = canvas.width / 2, targetY = canvas.height / 2;
            if (totalBrightness > 0) {
                targetX = sumX / totalBrightness;
                targetY = sumY / totalBrightness;
            }
    
            // Smooth with lerp
            const smoothing = 0.1;
            const threshold = 1.5; // Only update if movement is significant
            
            const deltaX = targetX - smoothedX;
            const deltaY = targetY - smoothedY;
            
            if (Math.abs(deltaX) > threshold || Math.abs(deltaY) > threshold) {
                smoothedX += deltaX * smoothing;
                smoothedY += deltaY * smoothing;
            }
        } catch (err) {
            console.error("Purple light tracking error:", err);
        }
    
        requestAnimationFrame(trackPurpleForeheadLight);
    }

    video.addEventListener("play", () => {
        requestAnimationFrame(trackPurpleForeheadLight);
    });

    function drawEnergyBall() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        const cx = smoothedX - 5;
        const cy = smoothedY + 15;

        ctx.fillStyle = 'rgba(0, 0, 0, 0.2)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ambientParticles.forEach(p => {
            p.x += p.dx;
            p.y += p.dy;
            if (p.x < 0 || p.x > canvas.width || p.y < 0 || p.y > canvas.height)
                Object.assign(p, createAmbientParticle());
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, 2 * Math.PI);
            ctx.fillStyle = `rgba(200, 100, 255, ${p.alpha})`;
            ctx.fill();
        });

        swirlParticlesPink.forEach(p => {
            p.angle += p.speed * p.direction;
            const x = cx + Math.cos(p.angle) * p.distance;
            const y = cy + Math.sin(p.angle) * p.distance;
            ctx.beginPath();
            ctx.arc(x, y, p.size, 0, 2 * Math.PI);
            ctx.fillStyle = `rgba(255, 105, 180, ${p.alpha})`;
            ctx.fill();
        });

        swirlParticlesBlue.forEach(p => {
            p.angle += p.speed * p.direction;
            const x = cx + Math.cos(p.angle) * p.distance;
            const y = cy + Math.sin(p.angle) * p.distance;
            ctx.beginPath();
            ctx.arc(x, y, p.size, 0, 2 * Math.PI);
            ctx.fillStyle = `rgba(100, 200, 255, ${p.alpha})`;
            ctx.fill();
        });

        layers.forEach(layer => {
            const radius = layer.base + layer.pulse + Math.sin(Date.now() / 300 + layer.speed) * 2;
            const gradient = ctx.createRadialGradient(cx, cy, 20, cx, cy, radius);
            gradient.addColorStop(0, `${layer.color}${layer.alpha})`);
            gradient.addColorStop(1, "rgba(0, 0, 0, 0)");

            ctx.fillStyle = gradient;
            ctx.beginPath();
            ctx.arc(cx, cy, radius, 0, 2 * Math.PI);
            ctx.fill();

            const flicker = (Math.random() * layer.speed) + 0.3;
            if (isSpeaking) {
                const intensity = Math.random() * 1.5 + 1.2; // Higher = more dynamic when speaking
                const flicker = (Math.random() * layer.speed * intensity) + 0.8; // Boosted baseline
                layer.pulse += layer.direction * flicker;
            
                // Reverse direction if out of bounds
                if (layer.pulse > layer.max || layer.pulse < -10) layer.direction *= -1;
            
                // Occasionally change direction for random feel
                if (Math.random() < 0.05) layer.direction *= -1;
            } else {
                // Smooth decay to neutral
                layer.pulse += (0 - layer.pulse) * 0.08;
            }
        });

        requestAnimationFrame(drawEnergyBall);

        // ⚡ Animate electric arcs
electricArcs.forEach((arc, index) => {
    ctx.beginPath();
    ctx.moveTo(arc.points[0].x, arc.points[0].y);

    for (let i = 1; i < arc.points.length; i++) {
        ctx.lineTo(arc.points[i].x, arc.points[i].y);
    }

    ctx.strokeStyle = `rgba(0, 200, 255, ${arc.alpha})`;
    ctx.lineWidth = 1.2;
    ctx.shadowBlur = 8;
    ctx.shadowColor = `rgba(0, 200, 255, ${arc.alpha})`;
    ctx.stroke();

    arc.alpha -= 0.05;
    arc.lifetime--;

    if (arc.lifetime <= 0 || arc.alpha <= 0) {
        electricArcs.splice(index, 1);
    }
});

// ⚡ Randomly emit arcs while speaking
if (isSpeaking && Math.random() < 0.2) {
    electricArcs.push(createElectricArc());
}

ctx.shadowBlur = 0;
    }

    drawEnergyBall();
})();

(function () {
    const dial = document.getElementById("nyrix-dial");
    const liveDisplay = document.getElementById("combo-numbers");
    let rotation = 0;
    let isDragging = false;
    let lastAngle = null;
    let comboSequence = [];
  
    // 🔁 Get angle based on mouse
    function getAngle(x, y, cx, cy) {
      return Math.atan2(y - cy, x - cx) * 180 / Math.PI;
    }
  
    // 🎯 Get dial number from rotation (0–99)
    function getDialNumber(rot) {
      const normalized = ((rot % 360) + 360) % 360;
      return Math.round((normalized / 360) * 100) % 100;
    }
  
    // 🔢 Update rolling display live
    function updateLiveDisplay(num) {
      const paddedCombo = [...comboSequence];
      while (paddedCombo.length < 3) paddedCombo.unshift("--");
      liveDisplay.textContent = `LIVE: ${String(num).padStart(2, "0")} | Combo: ${paddedCombo.map(n => String(n).padStart(2, "0")).join(" ")}`;
    }
  
    // 🖱️ Start dragging
    dial.addEventListener("mousedown", (e) => {
      isDragging = true;
      lastAngle = null;
    });
  
    // 🖱️ Stop dragging, lock in number
    window.addEventListener("mouseup", () => {
      if (!isDragging) return;
      isDragging = false;
  
      const lockedNumber = getDialNumber(rotation);
      comboSequence.push(lockedNumber);
      if (comboSequence.length > 3) comboSequence.shift();
  
      updateLiveDisplay(lockedNumber);
  
      // 🔐 Check for correct combo
      if (comboSequence.join("-") === "22-14-7") {
        document.getElementById("disable-nyrix-button").style.display = "inline-block";
      }
    });
  
    // 🌀 Rotate the dial on drag
    window.addEventListener("mousemove", (e) => {
      if (!isDragging) return;
  
      const rect = dial.getBoundingClientRect();
      const cx = rect.left + rect.width / 2;
      const cy = rect.top + rect.height / 2;
      const angle = getAngle(e.clientX, e.clientY, cx, cy);
  
      if (lastAngle === null) {
        lastAngle = angle;
        return;
      }
  
      let diff = angle - lastAngle;
      if (diff > 180) diff -= 360;
      if (diff < -180) diff += 360;
  
      rotation += diff;
      lastAngle = angle;
  
      dial.style.transform = `rotate(${rotation}deg)`;
  
      const currentNum = getDialNumber(rotation);
      updateLiveDisplay(currentNum);
    });
  })();
