import java.util.ArrayList;
import java.util.List;

class ControladorVenta {
    private List<Entrada> entradas = new ArrayList<>();

    public void agregarEntrada(Entrada entrada) {
        entradas.add(entrada);
    }

    public void comprarEntrada(String tipoEntrada) {
        Entrada entrada = encontrarEntrada(tipoEntrada);

        if(entrada == null) {
            System.out.println("Entrada no encontrada");
            return;
        }

        if(entrada.getDisponible()) {
            entrada.setDisponible(false);
            System.out.println("Entrada comprada");
        }else {
            System.out.println("Entrada no disponible");
        }
    }

    private Entrada encontrarEntrada(String tipoEntrada) {
        for (Entrada entrada : entradas) {
            if (entrada.getTipo().equals(tipoEntrada)) {
                return entrada;
            }
        }
        return null;
    }
}
