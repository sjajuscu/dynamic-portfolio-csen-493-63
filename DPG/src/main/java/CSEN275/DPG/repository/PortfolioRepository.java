package CSEN275.DPG.repository;

import CSEN275.DPG.model.Portfolio;
import org.springframework.data.jpa.repository.JpaRepository;

public interface PortfolioRepository extends JpaRepository<Portfolio, Long> {
    Portfolio findFirstByUserId(Long userId);
}
