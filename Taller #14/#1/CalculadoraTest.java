import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.RepeatedTest;
import org.junit.jupiter.api.Test;
import static org.junit.jupiter.api.Assertions.*;

public class CalculadoraTest {
    private static Calculadora calc;

    @BeforeAll
    static void setUp() {
        calc = new Calculadora();
    }

    @Test
    void testSumar() {
        assertEquals(6, calc.sumar(4, 2));
        assertNotEquals(5, calc.sumar(4, 2));
        assertTrue(calc.sumar(4, 2) == 6);
        assertFalse(calc.sumar(4, 2) == 5);
    }

    @Test
    void testRestar() {
        assertEquals(2, calc.restar(4, 2));
        assertNotEquals(3, calc.restar(4, 2));
        assertTrue(calc.restar(4, 2) == 2);
        assertFalse(calc.restar(4, 2) == 3);
    }

    @Test
    void testMultiplicar() {
        assertEquals(8, calc.multiplicar(4, 2));
        assertNotEquals(7, calc.multiplicar(4, 2));
        assertTrue(calc.multiplicar(4, 2) == 8);
        assertFalse(calc.multiplicar(4, 2) == 7);
    }

    @Test
    void testDividir() {
        assertEquals(2, calc.dividir(4, 2));
        assertNotEquals(3, calc.dividir(4, 2));
        assertTrue(calc.dividir(4, 2) == 2);
        assertFalse(calc.dividir(4, 2) == 3);
    }

    @RepeatedTest(5)
    void testSumarRepeated() {
        assertEquals(6, calc.sumar(4, 2));
    }

    @RepeatedTest(5)
    void testRestarRepeated() {
        assertEquals(2, calc.restar(4, 2));
    }

    @RepeatedTest(5)
    void testMultiplicarRepeated() {
        assertEquals(8, calc.multiplicar(4, 2));
    }

    @RepeatedTest(5)
    void testDividirRepeated() {
        assertEquals(2, calc.dividir(4, 2));
    }
}
