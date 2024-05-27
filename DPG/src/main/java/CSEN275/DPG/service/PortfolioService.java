package CSEN275.DPG.service;

import CSEN275.DPG.model.EducationalDetails;
import CSEN275.DPG.model.ExperienceDetails;
import CSEN275.DPG.model.Portfolio;
import CSEN275.DPG.model.Project;

import java.util.Collection;

public interface PortfolioService {
    Collection<Portfolio> getPortfolios();

    Portfolio getPortfolio(Long id);

    Portfolio createPortfolio(Portfolio portfolio);

    Collection<EducationalDetails> getEducations(Long id);

    Collection<EducationalDetails> addEducation(EducationalDetails details, Long id);

    EducationalDetails updateEducation(EducationalDetails details, Long pId, Long eId);

    void deleteEducation(Long pId, Long eId);

    Collection<ExperienceDetails> getExperiences(Long id);

    Collection<ExperienceDetails> addExperience(ExperienceDetails details, Long id);

    ExperienceDetails updateExperience(ExperienceDetails details, Long pId, Long eId);

    void deleteExperience(Long pId, Long eId);

    Collection<Project> getProjects(Long id);

    Collection<Project> addProject(Project project, Long id);

    Project updateProject(Project details, Long pId, Long eId);

    void deleteProject(Long pId, Long eId);
}
