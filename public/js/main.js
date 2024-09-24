let particles = {}; // 粒子データを格納するオブジェクト
let frame = 0;
let maxFrames = 0;
let x_min = Infinity,
    x_max = -Infinity;
let y_min = Infinity,
    y_max = -Infinity;
let z_min = Infinity,
    z_max = -Infinity;

// JSON データを読み込む
fetch("http://localhost:8080/calc.php")
    .then((response) => response.json())
    .then((data) => {
        particles = data;
        calculateBoundsAndFrames();
        createPlot();
    });

function calculateBoundsAndFrames() {
    for (let frameKey in particles) {
        let frameIndex = parseInt(frameKey.replace("#", ""));
        if (frameIndex > maxFrames) {
            maxFrames = frameIndex;
        }
        for (let particle_id in particles[frameKey]) {
            let coords = particles[frameKey][particle_id];
            let x = parseFloat(coords[0]);
            let y = parseFloat(coords[1]);
            let z = parseFloat(coords[2]);
            if (x < x_min) x_min = x;
            if (x > x_max) x_max = x;
            if (y < y_min) y_min = y;
            if (y > y_max) y_max = y;
            if (z < z_min) z_min = z;
            if (z > z_max) z_max = z;
        }
    }
    maxFrames += 1; // フレーム数をインデックスからカウントに変換
}

function createPlot() {
    let frames = [];
    for (let i = 0; i < maxFrames; i++) {
        let frameKey = `#${i}`;
        if (particles[frameKey]) {
            let x = [];
            let y = [];
            let z = [];
            for (let particle_id in particles[frameKey]) {
                let coords = particles[frameKey][particle_id];
                x.push(parseFloat(coords[0]));
                y.push(parseFloat(coords[1]));
                z.push(parseFloat(coords[2]));
            }
            frames.push({
                name: frameKey,
                data: [
                    {
                        x: x,
                        y: y,
                        z: z,
                        mode: "markers",
                        type: "scatter3d",
                        marker: { size: 2 },
                    },
                ],
            });
        }
    }

    let layout = {
        title: "Particle Animation",
        scene: {
            xaxis: { range: [x_min, x_max] },
            yaxis: { range: [y_min, y_max] },
            zaxis: { range: [z_min, z_max] },
        },
        updatemenus: [
            {
                type: "buttons",
                showactive: false,
                buttons: [
                    {
                        label: "Play",
                        method: "animate",
                        args: [
                            null,
                            {
                                fromcurrent: true,
                                frame: { redraw: true, duration: 100 },
                                transition: { duration: 0 },
                                mode: "immediate",
                                loop: true, // リピート再生を有効にする
                            },
                        ],
                    },
                ],
            },
        ],
    };

    Plotly.newPlot("plot", frames[0].data, layout).then(function () {
        Plotly.addFrames("plot", frames);
    });
}
