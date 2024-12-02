package Tercera_pregunta;

public class AdaptadorSistemaPago implements SistemaPagoAntiguo {
    private final NuevoSistemaPago nuevoSistemaPago;

    public AdaptadorSistemaPago(NuevoSistemaPago nuevoSistemaPago) {
        this.nuevoSistemaPago = nuevoSistemaPago;
    }

    @Override
    public void iniciarSesion(String usuario) {
        System.out.println("Creando la sesion para: " + nuevoSistemaPago.getNombre());
    }

    @Override
    public void validarEmail(String email) {
        System.out.println("Validando el correo: " + nuevoSistemaPago.getCorreo());
    }

    @Override
    public void autorizarPago() {
        System.out.println("Se esta validando la autorizacion, espere por favor......");
    }

    @Override
    public void ejecutarPago() {
        System.out.println("Pago realizado con exito, gracias por su compra.");
    }
}
