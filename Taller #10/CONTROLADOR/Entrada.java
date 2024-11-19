public class Entrada {
    private String tipo;
    private double precio;
    private boolean disponible;

    public Entrada(String tipo, double precio, boolean disponible) {
        this.tipo = tipo;
        this.precio = precio;
        this.disponible = disponible;
    }

    public String getTipo() {
        return tipo;
    }

    public double getPrecio() {
        return precio;
    }

    public boolean getDisponible() {
        return disponible;
    }

    public void setDisponible(boolean disponible) {
        this.disponible = disponible;
    }
}