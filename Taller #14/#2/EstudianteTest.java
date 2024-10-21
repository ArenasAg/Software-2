import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import static org.junit.jupiter.api.Assertions.*;

public class EstudianteTest {
    private static Estudiante estudiante;

    @BeforeAll
    static void setUp() {
        estudiante = new Estudiante("Juan", 20);
        estudiante.agregarCalificacion(8.0);
        estudiante.agregarCalificacion(6.0);
    }

    @AfterAll
    static void tearDown() {
        estudiante = null;
    }

    @Test
    void agregarCalificacionTest() {
        estudiante.agregarCalificacion(8.5);
        assertEquals(3, estudiante.getNumeroCalificaciones());
    }

    @Test
    void agregarCalificacionInvalidaTest() {
        Exception exception = assertThrows(IllegalArgumentException.class, () -> {
            estudiante.agregarCalificacion(11);
        });
        assertEquals("La calificación debe estar entre 0 y 10", exception.getMessage());
    }

    @Test
    void obtenerPromedioTest() {
        assertEquals(7.5, estudiante.obtenerPromedio());
    }

    @Test
    void getNumeroCalificacionesTest() {
        assertEquals(2, estudiante.getNumeroCalificaciones());
    }
}
