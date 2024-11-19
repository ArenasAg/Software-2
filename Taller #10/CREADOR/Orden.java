import java.util.ArrayList;
import java.util.List;

class Orden {
    private List<Computadora> computadoras = new ArrayList<>();
    private FabricaComputadoras fabricaComputadoras = new FabricaComputadoras();

    public void agregarComputadora(String procesador, String tarjetaGrafica, int ram) {
        Computadora computadora = fabricaComputadoras.crearComputadora(procesador, tarjetaGrafica, ram);
        computadoras.add(computadora);
    }

    public int calcularTotalComputadoras() {
        return computadoras.size();
    }

    public List<Computadora> getComputadoras() {
        return computadoras;
    }
}