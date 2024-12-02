package Quinta_pregunta;

public class EncenderComputadorCommand implements Command {
    private Computador computador;

    public EncenderComputadorCommand(Computador computador) {
        this.computador = computador;
    }

    @Override
    public void execute() {
        computador.encender();
    }
}