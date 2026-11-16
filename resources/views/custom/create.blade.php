<x-app-layout title="Configurador de Cuadros Personalizados — NachoResina">
    @push('styles')
    <style>
        .resin-preview-stage {
            min-height: 22rem;
            aspect-ratio: 4 / 3;
            display: grid;
            place-items: center;
            overflow: hidden;
            border-radius: 1rem;
            background:
                radial-gradient(ellipse at 50% 45%, rgba(255,255,255,.92), rgba(241,245,249,.9) 72%),
                #f1f5f9;
        }

        .resin-art-frame {
            max-width: calc(100% - 2rem);
            aspect-ratio: var(--art-ratio, 1.5 / 1);
            padding: .55rem;
            border-radius: .45rem;
            background: linear-gradient(145deg, #d6c6a7, #70583c 45%, #e2d3b7 72%, #66513b);
            box-shadow: 0 1.5rem 2.5rem -1.25rem rgba(15, 23, 42, .55), 0 .25rem .6rem rgba(15, 23, 42, .25);
            transition: aspect-ratio 280ms ease, width 280ms ease;
        }

        .resin-art {
            display: block;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: .12rem;
            background: #0c4a6e;
        }

        .resin-art [data-art-style] {
            display: none;
        }

        .resin-art[data-palette="ocean"] [data-art-style="ocean"],
        .resin-art[data-palette="geode"] [data-art-style="geode"],
        .resin-art[data-palette="marble"] [data-art-style="marble"],
        .resin-art[data-palette="emerald"] [data-art-style="emerald"] {
            display: block;
        }

        .resin-art[data-finish="matte"] {
            filter: saturate(.78) contrast(.96);
        }

        .resin-art[data-finish="matte"] #glossLayer {
            opacity: .08;
        }

        .resin-art[data-finish="metallic"] #glossLayer {
            opacity: .32;
        }

        .resin-art[data-finish="metallic"] [data-metallic-detail] {
            opacity: 1 !important;
        }

        .reference-preview-image {
            max-height: 12rem;
            object-fit: contain;
        }

        @media (max-width: 640px) {
            .resin-preview-stage {
                min-height: 17rem;
                aspect-ratio: auto;
            }

            .resin-art-frame {
                max-width: calc(100% - 1.5rem);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .resin-art-frame {
                transition: none;
            }
        }

        /* ===== Vista previa 3D con la imagen del cliente ===== */
        .resin-preview-stage {
            perspective: 900px;
        }

        .resin-art-frame {
            position: relative;
            transform-style: preserve-3d;
            will-change: transform;
        }

        .resin-photo-wrap {
            position: absolute;
            inset: .55rem;
            border-radius: .12rem;
            overflow: hidden;
            background: #0c4a6e;
        }

        .resin-photo {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Brillo de la resina: se mueve con el ángulo del cuadro */
        .resin-gloss {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at var(--gloss-x, 30%) var(--gloss-y, 15%), rgba(255,255,255,.4), rgba(255,255,255,0) 36%),
                linear-gradient(115deg, rgba(255,255,255,.24) 0%, rgba(255,255,255,.04) 34%, rgba(255,255,255,0) 55%, rgba(255,255,255,.16) 100%);
            mix-blend-mode: soft-light;
            opacity: .85;
        }

        /* El acabado mate apaga el brillo */
        .resin-art-frame[data-finish="matte"] .resin-gloss {
            opacity: .12;
        }

        @media (prefers-reduced-motion: reduce) {
            .resin-art-frame {
                transform: none !important;
            }
        }
    </style>
    @endpush

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-4">Crea tu Cuadro de Resina Personalizado</h1>
            <p class="text-slate-600 text-sm leading-relaxed">
                Diseña una obra exclusiva adaptada a las medidas, paleta de colores y acabados que imagines. Nuestro equipo de artistas la hará realidad con certificado de autenticidad.
            </p>
        </div>

        @if($errors->any())
            <div class="mb-6 max-w-3xl mx-auto bg-red-50 border border-red-200 text-red-800 text-sm p-4 rounded-xl">
                @foreach($errors->all() as $error)
                    <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 max-w-3xl mx-auto bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm p-4 rounded-xl">
                <p><i class="fa-solid fa-circle-check mr-1"></i> {{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start max-w-6xl mx-auto">
            <!-- Live Preview Card -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm lg:sticky lg:top-28">
                <h2 class="font-bold text-slate-900 mb-2 text-lg">Así podría verse tu cuadro</h2>
                <p class="text-sm text-slate-600 mb-5">La obra cambia mientras ajustas las opciones.</p>

                <div class="resin-preview-stage" aria-label="Previsualización ilustrativa del cuadro">
                    <div id="artPreviewFrame" class="resin-art-frame">
                        <svg id="artPreviewCanvas" class="resin-art" data-palette="ocean" data-finish="glossy" viewBox="0 0 1000 700" role="img" aria-labelledby="artPreviewTitle artPreviewDescription" preserveAspectRatio="xMidYMid slice">
                            <title id="artPreviewTitle">Ilustración de cuadro de resina</title>
                            <desc id="artPreviewDescription">Composición abstracta en tonos turquesa y azul profundo.</desc>
                            <defs>
                                <linearGradient id="oceanBase" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0" stop-color="#b6e4dc"/>
                                    <stop offset=".38" stop-color="#118c91"/>
                                    <stop offset="1" stop-color="#102c55"/>
                                </linearGradient>
                                <linearGradient id="geodeBase" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0" stop-color="#3d214b"/>
                                    <stop offset=".55" stop-color="#7c527e"/>
                                    <stop offset="1" stop-color="#21182f"/>
                                </linearGradient>
                                <linearGradient id="marbleBase" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0" stop-color="#f0ece3"/>
                                    <stop offset="1" stop-color="#c5c6c2"/>
                                </linearGradient>
                                <linearGradient id="emeraldBase" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0" stop-color="#b5d7c3"/>
                                    <stop offset=".46" stop-color="#187365"/>
                                    <stop offset="1" stop-color="#123a3a"/>
                                </linearGradient>
                                <linearGradient id="glossLayer" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0" stop-color="#fff" stop-opacity=".28"/>
                                    <stop offset=".34" stop-color="#fff" stop-opacity=".03"/>
                                    <stop offset=".72" stop-color="#fff" stop-opacity="0"/>
                                    <stop offset="1" stop-color="#fff" stop-opacity=".2"/>
                                </linearGradient>
                            </defs>
                            <rect width="1000" height="700" fill="url(#oceanBase)"/>

                            <g data-art-style="ocean">
                                <path d="M0 405C155 350 220 475 364 420S585 275 722 348s180 55 278 13v339H0Z" fill="#087f91" opacity=".8"/>
                                <path d="M0 492c137-76 242 64 365 13 140-58 184-164 323-113s201 31 312-37v345H0Z" fill="#123d68" opacity=".9"/>
                                <path d="M0 400c155-55 220 70 364 15s221-145 358-72 180 55 278 13" fill="none" stroke="#f4f3e8" stroke-width="18" stroke-linecap="round" opacity=".92"/>
                                <path d="M8 434c140-47 222 62 352 12 128-49 225-133 347-69" fill="none" stroke="#c6eee3" stroke-width="6" stroke-linecap="round" opacity=".86"/>
                                <path d="M0 565c155-53 237 42 356 4 120-38 203-111 327-67" fill="none" stroke="#6bd1c0" stroke-width="5" opacity=".7"/>
                            </g>

                            <g data-art-style="geode">
                                <path d="M0 0h1000v700H0Z" fill="url(#geodeBase)"/>
                                <ellipse cx="530" cy="355" rx="340" ry="250" fill="none" stroke="#d7a84d" stroke-width="18" opacity=".82"/>
                                <ellipse cx="530" cy="355" rx="292" ry="211" fill="none" stroke="#e9d7a5" stroke-width="12" opacity=".9"/>
                                <ellipse cx="530" cy="355" rx="246" ry="175" fill="none" stroke="#b78a47" stroke-width="9" opacity=".92"/>
                                <ellipse cx="530" cy="355" rx="196" ry="138" fill="#4a3560" stroke="#f0d79d" stroke-width="7"/>
                                <path d="m349 302 64-106 82 73-36 104Zm281-120 94 87-60 113-91-80ZM293 420l98 4 36 96-120 23Zm328 4 101-26-16 115-115 18Z" fill="#c6a6d2" opacity=".76"/>
                                <g data-metallic-detail fill="none" stroke="#f2d189" stroke-width="5" opacity=".55">
                                    <path d="M68 120c156 81 133 145 258 174M718 590c88-99 139-95 234-106"/>
                                    <path d="M122 609c107-59 130-58 210-40M750 105c76 45 104 82 142 154"/>
                                </g>
                            </g>

                            <g data-art-style="marble">
                                <path d="M0 0h1000v700H0Z" fill="url(#marbleBase)"/>
                                <path d="M-20 174c111-12 168 48 244 21 85-30 98-105 214-80s123 78 227 62 134-109 260-79" fill="none" stroke="#a9aaa7" stroke-width="28" opacity=".44"/>
                                <path d="M-12 181c113-12 164 43 244 16 84-29 102-106 212-80s126 78 230 62 134-106 265-76" fill="none" stroke="#b66d45" stroke-width="8" opacity=".92"/>
                                <path d="M-10 493c127-58 200-12 282 3 113 20 154-72 267-45s141 67 246 18 153-94 235-60" fill="none" stroke="#858987" stroke-width="34" opacity=".35"/>
                                <path d="M-10 498c127-58 200-12 282 3 113 20 154-72 267-45s141 67 246 18 153-94 235-60" fill="none" stroke="#c27c4b" stroke-width="7" opacity=".88"/>
                                <g data-metallic-detail fill="none" stroke="#b66d45" stroke-width="4" opacity=".58">
                                    <path d="M70 630c118-105 143-101 232-106M678 66c47 66 64 105 145 133"/>
                                    <path d="M449 675c87-73 122-72 200-80"/>
                                </g>
                            </g>

                            <g data-art-style="emerald">
                                <path d="M0 0h1000v700H0Z" fill="url(#emeraldBase)"/>
                                <path d="M0 248c119 82 197 38 302 91s175 115 289 51 174-102 268-53 101 89 141 88v275H0Z" fill="#0d4947" opacity=".79"/>
                                <path d="M0 247c119 82 197 38 302 91s175 115 289 51 174-102 268-53 101 89 141 88" fill="none" stroke="#d7ded0" stroke-width="10" opacity=".83"/>
                                <path d="M0 296c119 82 197 38 302 91s175 115 289 51 174-102 268-53 101 89 141 88" fill="none" stroke="#a8d1b4" stroke-width="5" opacity=".78"/>
                                <path d="M46 111c109-58 151 52 230 10M711 131c92 55 152 39 230-18" fill="none" stroke="#e0e5d7" stroke-width="7" opacity=".56"/>
                                <g data-metallic-detail fill="none" stroke="#d7ded0" stroke-width="4" opacity=".55">
                                    <path d="M149 625c103-82 140-67 227-43M736 566c82-52 122-60 187-41"/>
                                </g>
                            </g>

                            <rect width="1000" height="700" fill="url(#glossLayer)" opacity=".55"/>
                            <path d="M0 0h1000v700H0Z" fill="none" stroke="#fff" stroke-opacity=".22" stroke-width="8"/>
                        </svg>
                        <div id="photoPreviewWrap" class="resin-photo-wrap" hidden aria-hidden="true">
                            <img id="photoPreviewImg" class="resin-photo" alt="">
                            <div class="resin-gloss" aria-hidden="true"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap items-center justify-between gap-2 text-sm text-slate-700" aria-live="polite">
                    <span id="previewDimensionsBadge" class="font-semibold">60 x 60 cm</span>
                    <span id="previewPaletteText">Océano turquesa y azul profundo</span>
                    <span id="previewFinishBadge" class="text-slate-600">Brillante espejo</span>
                </div>

                <div id="referencePreviewPanel" class="hidden mt-5 border-t border-slate-200 pt-4">
                    <div class="flex items-center justify-between gap-3 mb-3">
                        <h3 class="text-sm font-semibold text-slate-800">Tu imagen de inspiración</h3>
                        <button id="removeReferenceImage" type="button" class="text-sm font-medium text-cyan-700 hover:text-cyan-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-700">
                            Quitar imagen
                        </button>
                    </div>
                    <div id="referencePreviewImageContainer"></div>
                </div>

                <div class="mt-6 bg-cyan-50 border border-cyan-100 p-4 rounded-xl text-xs text-cyan-800">
                    <p class="font-semibold mb-1">Vista orientativa</p>
                    <p>Los colores y las formas son una simulación basada en tus opciones, no una fotografía del resultado final. Cada pieza artesanal es única. Nuestro equipo confirmará el precio y el tiempo en la cotización.</p>
                </div>
            </div>

            <!-- Configurator Form -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                <form action="{{ route('custom.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nombre Completo</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="Tu Nombre">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Correo Electrónico</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="tu@correo.com">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Teléfono</label>
                            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="+34 600 000 000">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Medidas deseadas</label>
                        <select id="dimensionsSelect" name="dimensions" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500">
                            <option value="60x60 cm (Cuadrado)" data-aspect-ratio="1" {{ old('dimensions', '60x60 cm (Cuadrado)') === '60x60 cm (Cuadrado)' ? 'selected' : '' }}>60x60 cm (Cuadrado)</option>
                            <option value="90x60 cm (Mediano)" data-aspect-ratio="1.5" {{ old('dimensions') === '90x60 cm (Mediano)' ? 'selected' : '' }}>90x60 cm (Mediano)</option>
                            <option value="100x70 cm (Grande - Recomendado)" data-aspect-ratio="1.428571" {{ old('dimensions', '60x60 cm (Cuadrado)') === '100x70 cm (Grande - Recomendado)' ? 'selected' : '' }}>100x70 cm (Grande - Recomendado)</option>
                            <option value="120x80 cm (Gran Formato)" data-aspect-ratio="1.5" {{ old('dimensions') === '120x80 cm (Gran Formato)' ? 'selected' : '' }}>120x80 cm (Gran Formato)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Paleta de Colores</label>
                        <select id="paletteSelect" name="color_palette" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500">
                            <option value="Océano Turquesa y Azul Profundo" data-palette="ocean" {{ old('color_palette', 'Océano Turquesa y Azul Profundo') === 'Océano Turquesa y Azul Profundo' ? 'selected' : '' }}>Océano Turquesa y Azul Profundo</option>
                            <option value="Geoda Mineral con Vetas Doradas" data-palette="geode" {{ old('color_palette') === 'Geoda Mineral con Vetas Doradas' ? 'selected' : '' }}>Geoda Mineral con Vetas Doradas</option>
                            <option value="Mármol Blanco y Cobre Metálico" data-palette="marble" {{ old('color_palette') === 'Mármol Blanco y Cobre Metálico' ? 'selected' : '' }}>Mármol Blanco y Cobre Metálico</option>
                            <option value="Abstracción Esmeralda y Plata" data-palette="emerald" {{ old('color_palette') === 'Abstracción Esmeralda y Plata' ? 'selected' : '' }}>Abstracción Esmeralda y Plata</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Acabado Superficial</label>
                        <select id="finishSelect" name="finish" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500">
                            <option value="Brillante Espejo" data-finish="glossy" {{ old('finish', 'Brillante Espejo') === 'Brillante Espejo' ? 'selected' : '' }}>Brillante Espejo</option>
                            <option value="Mate Elegante" data-finish="matte" {{ old('finish') === 'Mate Elegante' ? 'selected' : '' }}>Mate Elegante</option>
                            <option value="Metálico con Relieve 3D" data-finish="metallic" {{ old('finish') === 'Metálico con Relieve 3D' ? 'selected' : '' }}>Metálico con Relieve 3D</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Descripción detallada de tu idea</label>
                        <textarea name="description" rows="4" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="Cuéntanos los detalles, ambiente donde irá ubicado, tonos específicos...">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Presupuesto aproximado (€) - Opcional</label>
                        <input type="number" name="budget" value="{{ old('budget') }}" step="50" min="100" class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="350">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Imagen de Referencia o Inspiración (Opcional - máx 4MB)</label>
                        <input id="referenceImageInput" type="file" name="reference_image" accept="image/*" aria-describedby="referenceImageStatus" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100">
                        <p id="referenceImageStatus" class="mt-2 text-xs text-slate-600" aria-live="polite">La imagen aparecerá aquí como referencia. Máximo 4 MB.</p>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-semibold py-4 rounded-xl shadow-lg hover:shadow-cyan-500/25 transition text-base">
                        Enviar Solicitud Personalizada
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        (() => {
            const dimensionsSelect = document.getElementById('dimensionsSelect');
            const paletteSelect = document.getElementById('paletteSelect');
            const finishSelect = document.getElementById('finishSelect');
            const artFrame = document.getElementById('artPreviewFrame');
            const artCanvas = document.getElementById('artPreviewCanvas');
            const photoWrap = document.getElementById('photoPreviewWrap');
            const photoImg = document.getElementById('photoPreviewImg');
            const dimensionsBadge = document.getElementById('previewDimensionsBadge');
            const paletteText = document.getElementById('previewPaletteText');
            const finishBadge = document.getElementById('previewFinishBadge');
            const previewStage = artFrame.parentElement;
            const imageInput = document.getElementById('referenceImageInput');
            const imagePanel = document.getElementById('referencePreviewPanel');
            const imagePreviewContainer = document.getElementById('referencePreviewImageContainer');
            const imageStatus = document.getElementById('referenceImageStatus');
            const removeImageButton = document.getElementById('removeReferenceImage');
            let imageUrl = null;
            let rafId = null;

            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

            function applyTilt(rx, ry) {
                artFrame.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg)`;
                artFrame.style.setProperty('--gloss-x', `${50 + ry * 4}%`);
                artFrame.style.setProperty('--gloss-y', `${50 - rx * 4}%`);
            }

            function tiltTo(rx, ry) {
                if (rafId) cancelAnimationFrame(rafId);
                rafId = requestAnimationFrame(() => applyTilt(rx, ry));
            }

            /* Efecto 3D siguiendo el ratón / dedo sobre el escenario */
            if (!prefersReducedMotion.matches) {
                previewStage.addEventListener('pointermove', (event) => {
                    const rect = previewStage.getBoundingClientRect();
                    const px = (event.clientX - rect.left) / rect.width - .5;
                    const py = (event.clientY - rect.top) / rect.height - .5;
                    tiltTo(-py * 10, px * 12);
                });

                previewStage.addEventListener('pointerleave', () => tiltTo(0, 0));
            }

            function fitArtwork() {
                const ratio = Number(dimensionsSelect.selectedOptions[0].dataset.aspectRatio);
                const availableWidth = previewStage.clientWidth - 32;
                const availableHeight = previewStage.clientHeight - 32;
                const width = Math.min(availableWidth, availableHeight * ratio);

                artFrame.style.width = `${width}px`;
                artFrame.style.height = `${width / ratio}px`;
            }

            function updatePreview() {
                const dimensions = dimensionsSelect.selectedOptions[0];
                const palette = paletteSelect.selectedOptions[0];
                const finish = finishSelect.selectedOptions[0];

                artFrame.style.setProperty('--art-ratio', `${dimensions.dataset.aspectRatio} / 1`);
                artCanvas.dataset.palette = palette.dataset.palette;
                artCanvas.dataset.finish = finish.dataset.finish;
                artFrame.dataset.finish = finish.dataset.finish;
                dimensionsBadge.textContent = dimensions.value.split(' (')[0].replace('x', ' x ');
                paletteText.textContent = palette.textContent;
                finishBadge.textContent = finish.textContent;
                artCanvas.querySelector('#artPreviewDescription').textContent =
                    `${palette.textContent}, acabado ${finish.textContent.toLowerCase()}.`;
                fitArtwork();
            }

            function clearReferenceImage() {
                if (imageUrl) {
                    URL.revokeObjectURL(imageUrl);
                    imageUrl = null;
                }

                imageInput.value = '';
                hideReferenceImage();
            }

            function hideReferenceImage() {
                imagePreviewContainer.replaceChildren();
                imagePanel.classList.add('hidden');

                /* Sin imagen, el cuadro vuelve a la ilustración abstracta */
                photoImg.src = '';
                photoWrap.hidden = true;
                photoWrap.setAttribute('aria-hidden', 'true');
                artCanvas.style.display = '';

                imageStatus.textContent = 'La imagen aparecerá aquí como referencia. Máximo 4 MB.';
                imageStatus.classList.remove('text-red-700');
                imageStatus.classList.add('text-slate-600');
            }

            dimensionsSelect.addEventListener('change', updatePreview);
            paletteSelect.addEventListener('change', updatePreview);
            finishSelect.addEventListener('change', updatePreview);
            window.addEventListener('resize', fitArtwork);
            if ('ResizeObserver' in window) {
                new ResizeObserver(fitArtwork).observe(previewStage);
            }
            removeImageButton.addEventListener('click', clearReferenceImage);
            imageInput.addEventListener('change', () => {
                const file = imageInput.files[0];
                if (imageUrl) {
                    URL.revokeObjectURL(imageUrl);
                    imageUrl = null;
                }
                hideReferenceImage();

                if (!file) {
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    imageStatus.textContent = 'Selecciona un archivo de imagen válido.';
                    imageStatus.classList.add('text-red-700');
                    imageStatus.classList.remove('text-slate-600');
                    imageInput.value = '';
                    return;
                }

                if (file.size > 4 * 1024 * 1024) {
                    imageStatus.textContent = 'La imagen supera los 4 MB. Elige un archivo más pequeño.';
                    imageStatus.classList.add('text-red-700');
                    imageStatus.classList.remove('text-slate-600');
                    imageInput.value = '';
                    return;
                }

                imageUrl = URL.createObjectURL(file);
                const imagePreview = document.createElement('img');
                imagePreview.className = 'reference-preview-image w-full rounded-lg bg-slate-100';
                imagePreview.alt = 'Vista previa de la imagen de inspiración seleccionada';
                imagePreview.src = imageUrl;
                imagePreviewContainer.replaceChildren(imagePreview);
                imagePanel.classList.remove('hidden');

                /* La imagen también se coloca dentro del cuadro 3D */
                photoImg.src = imageUrl;
                photoImg.alt = `Tu imagen dentro del cuadro de resina en formato ${dimensionsBadge.textContent}`;
                photoWrap.hidden = false;
                photoWrap.setAttribute('aria-hidden', 'false');
                artCanvas.style.display = 'none';

                imageStatus.textContent = `Imagen lista: ${file.name}`;
            });

            updatePreview();
        })();
    </script>
    @endpush
</x-app-layout>
