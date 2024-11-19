public class FabricaComputadoras {
    public Computadora crearComputadora(String procesador, String tarjetaGrafica, int ram) {
        return new Computadora(procesador, tarjetaGrafica, ram);
    }
}