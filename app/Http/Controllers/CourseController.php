<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Course;
use App\Models\Training_Center;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();

        if ($request->expectsJson()) {
            return response()->json([
                'data' => $courses,
            ], 200);
        }

        return view('Course.index', compact('courses'));
    }

    public function information(Course $course)
    {
        $offerImages = [
            'ADS-001' => 'storage/images/Imagen sena.jpg',
            'SIS-002' => 'storage/images/images.jpg',
            'ADM-003' => 'storage/images/Imagen sena.jpg',
            'CON-004' => 'storage/images/images.png',
        ];
        $offerDescriptions = [
            'ADS-001' => 'Aprende a analizar necesidades, diseñar soluciones y desarrollar aplicaciones de software para transformar ideas en herramientas digitales.',
            'SIS-002' => 'Fortalece tus habilidades para instalar, mantener y brindar soporte a equipos, redes y sistemas tecnológicos.',
            'ADM-003' => 'Desarrolla competencias para organizar procesos, gestionar documentos y apoyar de forma eficiente las actividades administrativas.',
            'CON-004' => 'Conoce los fundamentos contables y financieros para registrar operaciones, analizar información y apoyar la toma de decisiones.',
            'ELE-005' => 'Aprende principios de electricidad residencial, instalaciones seguras y mantenimiento de sistemas eléctricos básicos.',
            'GAS-006' => 'Explora técnicas de cocina, preparación de alimentos y buenas prácticas para crear experiencias gastronómicas.',
            'DIS-007' => 'Desarrolla tu creatividad con herramientas de diseño gráfico, composición visual y producción de piezas multimedia.',
            'LOG-008' => 'Comprende la planificación, organización y control de procesos logísticos y cadenas de suministro.',
            'AUT-009' => 'Acércate al control de procesos industriales mediante fundamentos de automatización, sensores y sistemas de operación.',
        ];
        $offerHighlights = [
            'ADS-001' => ['Lógica de programación y bases de datos', 'Diseño y desarrollo de aplicaciones', 'Pruebas y solución de problemas de software'],
            'SIS-002' => ['Mantenimiento de equipos y sistemas operativos', 'Instalación y soporte de redes', 'Atención de incidentes tecnológicos'],
            'ADM-003' => ['Organización de documentos y procesos', 'Servicio al cliente y comunicación empresarial', 'Herramientas ofimáticas para la gestión'],
            'CON-004' => ['Registro de operaciones contables', 'Manejo de soportes y documentos financieros', 'Análisis básico de costos e información'],
            'ELE-005' => ['Circuitos e instalaciones residenciales', 'Uso seguro de herramientas eléctricas', 'Mantenimiento de sistemas básicos'],
            'GAS-006' => ['Técnicas de preparación y cocción', 'Higiene y manipulación de alimentos', 'Presentación y creatividad gastronómica'],
            'DIS-007' => ['Principios de composición y color', 'Herramientas de diseño digital', 'Creación de piezas para medios visuales'],
            'LOG-008' => ['Inventarios y control de almacenes', 'Compras, distribución y transporte', 'Planeación de cadenas de suministro'],
            'AUT-009' => ['Sensores y sistemas de control', 'Fundamentos de automatización industrial', 'Diagnóstico de procesos y equipos'],
        ];
        $offerImage = $course->urlFoto
            ? 'storage/images/' . $course->urlFoto
            : ($offerImages[$course->course_number] ?? 'storage/images/Imagen sena.jpg');
        $offerDescription = $offerDescriptions[$course->course_number] ?? 'Conoce una oportunidad de formación práctica para fortalecer tus habilidades y prepararte para nuevos retos laborales.';
        $offerLearning = $offerHighlights[$course->course_number] ?? ['Formación práctica para el trabajo', 'Desarrollo de habilidades técnicas', 'Acompañamiento durante el proceso formativo'];

        return view('Course.information', compact('course', 'offerImage', 'offerDescription', 'offerLearning'));
    }

    public function create()
    {
        $areas = Area::all();
        $training_centers = Training_Center::all();
        $courses = Course::all();

        return view('Course.create', compact('areas', 'training_centers', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'schedule' => 'required|string|max:100',
            'duration_months' => 'required|integer|min:1|max:14',
            'course_number' => 'nullable|string|max:50',
            'day' => 'nullable|string|max:100',
            'area_id' => 'nullable|exists:areas,id',
            'training_center_id' => 'nullable|exists:training_centers,id',
        ]);

        $validated['course_number'] = $validated['course_number'] ?? strtoupper(substr($validated['name'], 0, 3));
        $validated['day'] = $validated['day'] ?? $validated['schedule'];
        $course = Course::create($validated);
        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            $nombreArchivo = 'foto_' . time() . '.' . $file->guessExtension();
            $file->storeAs('public/images', $nombreArchivo);
            $course->urlFoto = $nombreArchivo;
            $course->save();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Curso registrado correctamente.',
                'data' => $course->fresh(),
            ], 201);
        }

        return redirect()->route('courses.index')->with('success', 'Curso registrado correctamente.');
    }
}