package PrimerPregunta.KISS;

public class Main {
    public static void main(String[] args) {
        OrdenEstado ordenEstado = new OrdenEstado();
        String estado = ordenEstado.obtenerEstado(20);
        System.out.println(estado);
    }
}

class OrdenEstado {
    public String obtenerEstado(int ordenId) {
        if (ordenId < 0) {
            return "Orden Invalida";
        }
        if (ordenId == 0 || ordenId <= 50) {
            return "Pendiente";
        }
        if (ordenId <= 100) {
            return "En Progreso";
        }
        return "Completada";
    }
}

