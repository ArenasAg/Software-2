package Quinta_pregunta;

public class SuspenderComputadorCommand implements Command {
    private Computador computador;

    public SuspenderComputadorCommand(Computador computador) {
        this.computador = computador;
    }

    @Override
    public void execute() {
        computador.suspender();
    }
}
