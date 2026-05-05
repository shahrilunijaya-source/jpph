@props(['variant' => 'waves']) {{-- waves | aurora --}}

@if($variant === 'waves')
    {{-- eDSL-style WebGL plasma waves --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none bg-[#0f172a]" aria-hidden="true">
        <canvas class="jpph-wave-bg" style="position:absolute;inset:0;width:100%;height:100%;display:block;"></canvas>
    </div>

    @once
        @push('scripts')
            <script>
            (function () {
                if (window.__jpphWaveBgInit) return;
                window.__jpphWaveBgInit = true;

                var vsSource = "attribute vec4 aVertexPosition;void main(){gl_Position=aVertexPosition;}";
                var fsSource = `
                    precision highp float;
                    uniform vec2 iResolution;
                    uniform float iTime;

                    const float overallSpeed    = 0.2;
                    const float gridSmoothWidth = 0.015;
                    const float majorLineWidth  = 0.025;
                    const float minorLineWidth  = 0.0125;
                    const float scale           = 5.0;
                    const vec4  lineColor       = vec4(0.04, 0.45, 0.65, 1.0);
                    const float minLineWidth    = 0.005;
                    const float maxLineWidth    = 0.08;
                    const float lineSpeed       = 1.0  * overallSpeed;
                    const float lineAmplitude   = 1.0;
                    const float lineFrequency   = 0.2;
                    const float warpSpeed       = 0.2  * overallSpeed;
                    const float warpFrequency   = 0.5;
                    const float warpAmplitude   = 0.4;
                    const float offsetFrequency = 0.5;
                    const float offsetSpeed     = 1.33 * overallSpeed;
                    const float minOffsetSpread = 0.6;
                    const float maxOffsetSpread = 2.0;
                    const int   linesPerGroup   = 9;

                    #define drawCircle(pos,radius,coord) smoothstep(radius+gridSmoothWidth,radius,length(coord-(pos)))
                    #define drawSmoothLine(pos,hw,t)     smoothstep(hw,0.0,abs(pos-(t)))
                    #define drawCrispLine(pos,hw,t)      smoothstep(hw+gridSmoothWidth,hw,abs(pos-(t)))

                    float random(float t){return(cos(t)+cos(t*1.3+1.3)+cos(t*1.4+1.4))/3.0;}

                    float getPlasmaY(float x,float hf,float off){
                        return random(x*lineFrequency+iTime*lineSpeed)*hf*lineAmplitude+off;
                    }

                    void main(){
                        vec2 uv    = gl_FragCoord.xy/iResolution.xy;
                        vec2 space = (gl_FragCoord.xy-iResolution.xy/2.0)/iResolution.x*2.0*scale;

                        float hFade = 1.0-(cos(uv.x*6.28)*0.5+0.5);
                        float vFade = 1.0-(cos(uv.y*6.28)*0.5+0.5);

                        space.y += random(space.x*warpFrequency+iTime*warpSpeed)*warpAmplitude*(0.5+hFade);
                        space.x += random(space.y*warpFrequency+iTime*warpSpeed+2.0)*warpAmplitude*hFade;

                        vec4 lines    = vec4(0.0);
                        vec4 bgColor1 = vec4(0.04, 0.15, 0.25, 1.0);
                        vec4 bgColor2 = vec4(0.06, 0.22, 0.38, 1.0);

                        for(int l=0;l<linesPerGroup;l++){
                            float nl   = float(l)/float(linesPerGroup);
                            float ot   = iTime*offsetSpeed;
                            float op   = float(l)+space.x*offsetFrequency;
                            float rand = random(op+ot)*0.5+0.5;
                            float hw   = mix(minLineWidth,maxLineWidth,rand*hFade)/2.0;
                            float off  = random(op+ot*(1.0+nl))*mix(minOffsetSpread,maxOffsetSpread,hFade);
                            float lp   = getPlasmaY(space.x,hFade,off);
                            float line = drawSmoothLine(lp,hw,space.y)/2.0+drawCrispLine(lp,hw*0.15,space.y);
                            float cx   = mod(float(l)+iTime*lineSpeed,25.0)-12.0;
                            vec2  cp   = vec2(cx,getPlasmaY(cx,hFade,off));
                            line += drawCircle(cp,0.008,space)*1.5;
                            lines += line*lineColor*rand;
                        }

                        vec4 col = mix(bgColor1,bgColor2,uv.x);
                        col *= vFade; col.a = 1.0; col += lines * 0.45;
                        gl_FragColor = col;
                    }
                `;

                function loadShader(gl, type, src) {
                    var s = gl.createShader(type);
                    gl.shaderSource(s, src);
                    gl.compileShader(s);
                    if (!gl.getShaderParameter(s, gl.COMPILE_STATUS)) {
                        console.warn('jpph wave-bg shader compile error', gl.getShaderInfoLog(s));
                        gl.deleteShader(s);
                        return null;
                    }
                    return s;
                }

                function initCanvas(canvas) {
                    if (canvas.__jpphInit) return;
                    canvas.__jpphInit = true;

                    var gl = canvas.getContext('webgl', { antialias: true })
                          || canvas.getContext('experimental-webgl', { antialias: true });
                    if (!gl) return;

                    var vs = loadShader(gl, gl.VERTEX_SHADER, vsSource);
                    var fs = loadShader(gl, gl.FRAGMENT_SHADER, fsSource);
                    if (!vs || !fs) return;

                    var prog = gl.createProgram();
                    gl.attachShader(prog, vs);
                    gl.attachShader(prog, fs);
                    gl.linkProgram(prog);
                    if (!gl.getProgramParameter(prog, gl.LINK_STATUS)) {
                        console.warn('jpph wave-bg link error', gl.getProgramInfoLog(prog));
                        return;
                    }

                    var buf = gl.createBuffer();
                    gl.bindBuffer(gl.ARRAY_BUFFER, buf);
                    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1,1,-1,-1,1,1,1]), gl.STATIC_DRAW);

                    var aPos  = gl.getAttribLocation(prog, 'aVertexPosition');
                    var uRes  = gl.getUniformLocation(prog, 'iResolution');
                    var uTime = gl.getUniformLocation(prog, 'iTime');

                    function resize() {
                        var p = canvas.parentElement;
                        if (!p) return;
                        var dpr = Math.min(window.devicePixelRatio || 1, 2);
                        canvas.width  = Math.max(1, Math.floor(p.clientWidth  * dpr));
                        canvas.height = Math.max(1, Math.floor(p.clientHeight * dpr));
                        canvas.style.width  = p.clientWidth  + 'px';
                        canvas.style.height = p.clientHeight + 'px';
                        gl.viewport(0, 0, canvas.width, canvas.height);
                    }
                    window.addEventListener('resize', resize);
                    if ('ResizeObserver' in window) {
                        try { new ResizeObserver(resize).observe(canvas.parentElement); } catch (e) {}
                    }
                    resize();

                    var t0 = performance.now();
                    function render() {
                        var t = (performance.now() - t0) / 1000;
                        gl.clear(gl.COLOR_BUFFER_BIT);
                        gl.useProgram(prog);
                        gl.uniform2f(uRes, canvas.width, canvas.height);
                        gl.uniform1f(uTime, t);
                        gl.bindBuffer(gl.ARRAY_BUFFER, buf);
                        gl.vertexAttribPointer(aPos, 2, gl.FLOAT, false, 0, 0);
                        gl.enableVertexAttribArray(aPos);
                        gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
                        requestAnimationFrame(render);
                    }
                    render();
                }

                function scan() {
                    document.querySelectorAll('canvas.jpph-wave-bg').forEach(initCanvas);
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', scan);
                } else {
                    scan();
                }
                document.addEventListener('livewire:navigated', scan);
                document.addEventListener('livewire:load', scan);
            })();
            </script>
        @endpush
    @endonce
@else
    {{-- Aurora variant fallback --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(201,162,39,0.18),transparent_55%),radial-gradient(ellipse_at_bottom_right,rgba(59,130,246,0.18),transparent_55%)]"></div>
        <div class="absolute -top-48 -left-48 w-[40rem] h-[40rem] rounded-full bg-gold/30 blur-3xl motion-safe:animate-aurora-1 will-change-transform"></div>
        <div class="absolute -bottom-48 -right-48 w-[44rem] h-[44rem] rounded-full bg-blue-500/25 blur-3xl motion-safe:animate-aurora-2 will-change-transform"></div>
        <div class="absolute top-1/2 left-1/2 w-[32rem] h-[32rem] rounded-full bg-fuchsia-500/15 blur-3xl motion-safe:animate-aurora-3 will-change-transform" style="transform: translate(-50%, -50%);"></div>
        <div class="absolute -inset-y-12 -inset-x-1/3 w-1/3 bg-gradient-to-r from-transparent via-white/10 to-transparent blur-2xl motion-safe:animate-aurora-curtain will-change-transform"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_40%,rgba(10,37,64,0.4)_100%)]"></div>
    </div>
@endif
