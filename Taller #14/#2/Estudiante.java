import java.util.ArrayList;
import java.util.List;

public class Estudiante {
    private String nombre;
    private int edad;
    private List<Double> calificaciones;

    public Estudiante(String nombre, int edad) {
        this.nombre = nombre;
        this.edad = edad;
        this.calificaciones = new ArrayList<>();
    }

    public void agregarCalificacion(double calificacion) {
        if(calificacion < 0 || calificacion > 10) {
            throw new IllegalArgumentException("La calificación debe estar entre 0 y 10");
        }
        calificaciones.add(calificacion);
    }

    public double obtenerPromedio() {
        return calificaciones.stream().mapToDouble(Double::doubleValue).average().orElse(0.0);
    }

    public String getNombre() {
        return nombre;
    }

    public int getEdad() {
        return edad;
    }

    public int getNumeroCalificaciones() {
        return calificaciones.size();
    }
}
