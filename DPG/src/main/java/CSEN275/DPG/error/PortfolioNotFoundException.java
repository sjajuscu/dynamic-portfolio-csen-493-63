package CSEN275.DPG.error;

public class PortfolioNotFoundException extends RuntimeException {
    public PortfolioNotFoundException(Long id) {
        super("Could not find portfolio with id=" + id);
    }
}
