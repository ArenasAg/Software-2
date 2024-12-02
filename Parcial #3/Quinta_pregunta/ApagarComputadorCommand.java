package Quinta_pregunta;

public class ApagarComputadorCommand implements Command {
    private Computador computador;

    public ApagarComputadorCommand(Computador computador) {
        this.computador = computador;
    }

    @Override
    public void execute() {
        computador.apagar();
    }
}