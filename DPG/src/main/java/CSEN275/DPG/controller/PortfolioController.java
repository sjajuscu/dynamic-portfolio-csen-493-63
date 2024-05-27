package CSEN275.DPG.controller;

import CSEN275.DPG.model.EducationalDetails;
import CSEN275.DPG.model.ExperienceDetails;
import CSEN275.DPG.model.Portfolio;
import CSEN275.DPG.model.Project;
import CSEN275.DPG.service.PortfolioService;
import CSEN275.DPG.utils.EducationalDetailsModelAssembler;
import CSEN275.DPG.utils.ExperienceDetailsModelAssembler;
import CSEN275.DPG.utils.PortfolioModelAssembler;
import CSEN275.DPG.utils.ProjectModelAssembler;
import org.springframework.hateoas.CollectionModel;
import org.springframework.hateoas.EntityModel;
import org.springframework.hateoas.IanaLinkRelations;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

import static org.springframework.hateoas.server.mvc.WebMvcLinkBuilder.linkTo;
import static org.springframework.hateoas.server.mvc.WebMvcLinkBuilder.methodOn;

@RestController
public class PortfolioController {
    private PortfolioService portfolioService;
    private PortfolioModelAssembler assembler;
    private EducationalDetailsModelAssembler educationAssembler;
    private ExperienceDetailsModelAssembler experienceAssembler;
    private ProjectModelAssembler projectAssembler;

    public PortfolioController(PortfolioService service, PortfolioModelAssembler assembler,
           EducationalDetailsModelAssembler educationAssembler, ExperienceDetailsModelAssembler experienceAssembler,
           ProjectModelAssembler projectAssembler) {
        this.portfolioService = service;
        this.assembler = assembler;
        this.educationAssembler = educationAssembler;
        this.experienceAssembler = experienceAssembler;
        this.projectAssembler = projectAssembler;
    }

    @GetMapping("/portfolios")
    public CollectionModel<EntityModel<Portfolio>> all() {
        List<EntityModel<Portfolio>> portfolios = portfolioService.getPortfolios().stream()
                .map(assembler::toModel)
                .toList();
        return CollectionModel.of(portfolios,
                linkTo(methodOn(PortfolioController.class).all()).withSelfRel());
    }

    @PostMapping("/portfolios")
    public ResponseEntity<?> createPortfolio(@RequestBody Portfolio newPortfolio){
        EntityModel<Portfolio> entityModel = assembler.toModel(portfolioService.createPortfolio(newPortfolio));

        return ResponseEntity
                .created(entityModel.getRequiredLink(IanaLinkRelations.SELF).toUri())
                .body(entityModel);
    }

    @GetMapping("/portfolios/{id}")
    public EntityModel<Portfolio> one(@PathVariable Long id) {
        Portfolio portfolio = portfolioService.getPortfolio(id);
        return assembler.toModel(portfolio);
    }

    @GetMapping("/portfolios/{id}/educations")
    public CollectionModel<EntityModel<EducationalDetails>> getAllEducations(@PathVariable Long id) {
        List<EntityModel<EducationalDetails>> educations = portfolioService.getEducations(id).stream()
                .map(educationAssembler::toModel)
                .toList();
        return CollectionModel.of(educations,
                linkTo(methodOn(PortfolioController.class).getAllEducations(id)).withSelfRel());
    }

    @PostMapping("/portfolios/{id}/educations")
    public CollectionModel<EntityModel<EducationalDetails>> addEducation(@RequestBody EducationalDetails details, @PathVariable Long id) {
        List<EntityModel<EducationalDetails>> entityModelList = portfolioService.addEducation(details, id).stream()
                .map(educationAssembler::toModel)
                .toList();
        return CollectionModel.of(entityModelList,
                linkTo(methodOn(PortfolioController.class).getAllEducations(id)).withSelfRel());
    }

    @PostMapping("/portfolios/{pId}/educations/{eId}")
    public EntityModel<EducationalDetails> updateEducation(@RequestBody EducationalDetails details, @PathVariable Long pId, @PathVariable Long eId) {
        EducationalDetails updatedDetails = portfolioService.updateEducation(details, pId, eId);
        return educationAssembler.toModel(updatedDetails);
    }

    @DeleteMapping("/portfolios/{pId}/educations/{eId}")
    ResponseEntity<?> deleteEducation(@PathVariable Long pId, @PathVariable Long eId) {
        portfolioService.deleteEducation(pId, eId);
        return ResponseEntity.noContent().build();
    }

    @GetMapping("/portfolios/{id}/experiences")
    public CollectionModel<EntityModel<ExperienceDetails>> getAllExperiences(@PathVariable Long id) {
        List<EntityModel<ExperienceDetails>> experiences = portfolioService.getExperiences(id).stream()
                .map(experienceAssembler::toModel)
                .toList();
        return CollectionModel.of(experiences,
                linkTo(methodOn(PortfolioController.class).getAllExperiences(id)).withSelfRel());
    }

    @PostMapping("/portfolios/{id}/experiences")
    public CollectionModel<EntityModel<ExperienceDetails>> addExperience(@RequestBody ExperienceDetails details, @PathVariable Long id) {
        List<EntityModel<ExperienceDetails>> entityModelList = portfolioService.addExperience(details, id).stream()
                .map(experienceAssembler::toModel)
                .toList();
        return CollectionModel.of(entityModelList,
                linkTo(methodOn(PortfolioController.class).getAllExperiences(id)).withSelfRel());
    }

    @PostMapping("/portfolios/{pId}/experiences/{eId}")
    public EntityModel<ExperienceDetails> updateEducation(@RequestBody ExperienceDetails details, @PathVariable Long pId, @PathVariable Long eId) {
        ExperienceDetails updatedDetails = portfolioService.updateExperience(details, pId, eId);
        return experienceAssembler.toModel(updatedDetails);
    }

    @DeleteMapping("/portfolios/{pId}/experiences/{eId}")
    ResponseEntity<?> deleteExperience(@PathVariable Long pId, @PathVariable Long eId) {
        portfolioService.deleteExperience(pId, eId);
        return ResponseEntity.noContent().build();
    }

    @GetMapping("/portfolios/{id}/projects")
    public CollectionModel<EntityModel<Project>> getAllProjects(@PathVariable Long id) {
        List<EntityModel<Project>> projects = portfolioService.getProjects(id).stream()
                .map(projectAssembler::toModel)
                .toList();
        return CollectionModel.of(projects,
                linkTo(methodOn(PortfolioController.class).getAllProjects(id)).withSelfRel());
    }

    @PostMapping("/portfolios/{id}/projects")
    public CollectionModel<EntityModel<Project>> addProject(@RequestBody Project project, @PathVariable Long id) {
        List<EntityModel<Project>> entityModelList = portfolioService.addProject(project, id).stream()
                .map(projectAssembler::toModel)
                .toList();
        return CollectionModel.of(entityModelList,
                linkTo(methodOn(PortfolioController.class).getAllProjects(id)).withSelfRel());
    }

    @PostMapping("/portfolios/{pId}/projects/{eId}")
    public EntityModel<Project> updateProject(@RequestBody Project details, @PathVariable Long pId, @PathVariable Long eId) {
        Project updatedDetails = portfolioService.updateProject(details, pId, eId);
        return projectAssembler.toModel(updatedDetails);
    }

    @DeleteMapping("/portfolios/{pId}/projects/{eId}")
    ResponseEntity<?> deleteProject(@PathVariable Long pId, @PathVariable Long eId) {
        portfolioService.deleteProject(pId, eId);
        return ResponseEntity.noContent().build();
    }
}
