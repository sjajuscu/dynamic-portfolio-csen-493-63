package CSEN275.DPG.service;

import CSEN275.DPG.error.PortfolioAlreadyExistsException;
import CSEN275.DPG.error.PortfolioNotFoundException;
import CSEN275.DPG.model.EducationalDetails;
import CSEN275.DPG.model.ExperienceDetails;
import CSEN275.DPG.model.Portfolio;
import CSEN275.DPG.model.Project;
import CSEN275.DPG.repository.PortfolioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.stereotype.Service;

import java.util.Collection;

@Service
public class PortfolioServiceImpl implements PortfolioService {
    private final PortfolioRepository repository;

    @Autowired
    public PortfolioServiceImpl(PortfolioRepository repository) {
        this.repository = repository;
    }

    @Override
    public Collection<Portfolio> getPortfolios() {
        return repository.findAll();
    }

    @Override
    public Portfolio createPortfolio(Portfolio portfolio) {
        Portfolio existingPortfolio = repository.findFirstByUserId(portfolio.getUserId());
        if (existingPortfolio != null) {
            throw new PortfolioAlreadyExistsException(portfolio.getUserId());
        }
        return repository.save(portfolio);
    }

    @Override
    public Collection<EducationalDetails> getEducations(Long id) {
        Portfolio existingPortfolio = repository.findById(id)
                .orElseThrow(() -> new PortfolioNotFoundException(id));
        return existingPortfolio.getEducations();
    }

    @Override
    @PreAuthorize("hasRole('ROLE_ADMIN') or @authz.canEditPortfolio(#id)")
    public Collection<EducationalDetails> addEducation(EducationalDetails details, Long id) {
        Portfolio existingPortfolio = repository.findById(id)
                .orElseThrow(() -> new PortfolioNotFoundException(id));
        existingPortfolio.addEducationalDetails(details);
        repository.save(existingPortfolio);
        return existingPortfolio.getEducations();
    }

    @Override
    @PreAuthorize("hasRole('ROLE_ADMIN') or @authz.canEditPortfolio(#pId)")
    public EducationalDetails updateEducation(EducationalDetails details, Long pId, Long eId) {
        Portfolio existingPortfolio = repository.findById(pId)
                .orElseThrow(() -> new PortfolioNotFoundException(pId));
        existingPortfolio.updateEducation(details, eId);
        repository.save(existingPortfolio);
        return existingPortfolio.getEducation(eId);
    }

    @Override
    @PreAuthorize("hasRole('ROLE_ADMIN') or @authz.canEditPortfolio(#pId)")
    public void deleteEducation(Long pId, Long eId) {
        Portfolio existingPortfolio = repository.findById(pId)
                .orElseThrow(() -> new PortfolioNotFoundException(pId));
        existingPortfolio.deleteEducation(eId);
        repository.save(existingPortfolio);
    }

    @Override
    public Portfolio getPortfolio(Long id) {
        return repository.findById(id)
                .orElseThrow(() -> new PortfolioNotFoundException(id));
    }

    @Override
    public Collection<ExperienceDetails> getExperiences(Long id) {
        Portfolio existingPortfolio = repository.findById(id)
                .orElseThrow(() -> new PortfolioNotFoundException(id));
        return existingPortfolio.getExperiences();
    }

    @Override
    @PreAuthorize("hasRole('ROLE_ADMIN') or @authz.canEditPortfolio(#id)")
    public Collection<ExperienceDetails> addExperience(ExperienceDetails details, Long id) {
        Portfolio existingPortfolio = repository.findById(id)
                .orElseThrow(() -> new PortfolioNotFoundException(id));
        existingPortfolio.addExperienceDetails(details);
        repository.save(existingPortfolio);
        return existingPortfolio.getExperiences();
    }

    @Override
    @PreAuthorize("hasRole('ROLE_ADMIN') or @authz.canEditPortfolio(#pId)")
    public ExperienceDetails updateExperience(ExperienceDetails details, Long pId, Long eId) {
        Portfolio existingPortfolio = repository.findById(pId)
                .orElseThrow(() -> new PortfolioNotFoundException(pId));
        existingPortfolio.updateExperience(details, eId);
        repository.save(existingPortfolio);
        return existingPortfolio.getExperience(eId);
    }

    @Override
    @PreAuthorize("hasRole('ROLE_ADMIN') or @authz.canEditPortfolio(#pId)")
    public void deleteExperience(Long pId, Long eId) {
        Portfolio existingPortfolio = repository.findById(pId)
                .orElseThrow(() -> new PortfolioNotFoundException(pId));
        existingPortfolio.deleteExperience(eId);
        repository.save(existingPortfolio);
    }

    @Override
    public Collection<Project> getProjects(Long id) {
        Portfolio existingPortfolio = repository.findById(id)
                .orElseThrow(() -> new PortfolioNotFoundException(id));
        return existingPortfolio.getProjects();
    }

    @Override
    @PreAuthorize("hasRole('ROLE_ADMIN') or @authz.canEditPortfolio(#id)")
    public Collection<Project> addProject(Project project, Long id) {
        Portfolio existingPortfolio = repository.findById(id)
                .orElseThrow(() -> new PortfolioNotFoundException(id));
        existingPortfolio.addProject(project);
        repository.save(existingPortfolio);
        return existingPortfolio.getProjects();
    }

    @Override
    @PreAuthorize("hasRole('ROLE_ADMIN') or @authz.canEditPortfolio(#pId)")
    public Project updateProject(Project details, Long pId, Long eId) {
        Portfolio existingPortfolio = repository.findById(pId)
                .orElseThrow(() -> new PortfolioNotFoundException(pId));
        existingPortfolio.updateProject(details, eId);
        repository.save(existingPortfolio);
        return existingPortfolio.getProject(eId);
    }

    @Override
    @PreAuthorize("hasRole('ROLE_ADMIN') or @authz.canEditPortfolio(#pId)")
    public void deleteProject(Long pId, Long eId) {
        Portfolio existingPortfolio = repository.findById(pId)
                .orElseThrow(() -> new PortfolioNotFoundException(pId));
        existingPortfolio.deleteProject(eId);
        repository.save(existingPortfolio);
    }
}
