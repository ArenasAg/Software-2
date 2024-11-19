// Clase base abstracta para Envio
interface Envio {
    double calcularCosto(double peso, double distancia);
}

// Clase concreta para EnvioEstandar
class EnvioEstandar implements Envio {
    @Override
    public double calcularCosto(double peso, double distancia) {
        return peso * 0.5 + distancia * 0.1;
    }
}

// Clase concreta para EnvioExpress
class EnvioExpress implements Envio {
    @Override
    public double calcularCosto(double peso, double distancia) {
        return peso * 1.0 + distancia * 0.2;
    }
}

// Clase concreta para EnvioInternacional
class EnvioInternacional implements Envio {
    @Override
    public double calcularCosto(double peso, double distancia) {
        return peso * 2.0 + distancia * 0.3;
    }
}

// Clase principal para pruebas
public class Main {
    public static void main(String[] args) {
        Envio envioEstandar = new EnvioEstandar();
        Envio envioExpress = new EnvioExpress();
        Envio envioInternacional = new EnvioInternacional();

        double peso = 10.0;
        double distancia = 100.0;

        System.out.println("Costo Envio Estandar: " + envioEstandar.calcularCosto(peso, distancia));
        System.out.println("Costo Envio Express: " + envioExpress.calcularCosto(peso, distancia));
        System.out.println("Costo Envio Internacional: " + envioInternacional.calcularCosto(peso, distancia));
    }
}
