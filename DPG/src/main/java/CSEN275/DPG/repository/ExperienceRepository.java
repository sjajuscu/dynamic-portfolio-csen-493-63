package CSEN275.DPG.repository;

import CSEN275.DPG.model.ExperienceDetails;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ExperienceRepository extends JpaRepository<ExperienceDetails, Long> {
}
