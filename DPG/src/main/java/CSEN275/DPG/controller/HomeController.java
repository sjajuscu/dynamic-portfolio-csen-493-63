package CSEN275.DPG.controller;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.servlet.ModelAndView;

@RestController
public class HomeController {
    @RequestMapping(value = {"/", "/home"})
    public ModelAndView home() {
        ModelAndView modelAndView = new ModelAndView();
        modelAndView.setViewName("home.html");
        return modelAndView;
    }

    @RequestMapping("/login")
    public ModelAndView login() {
        ModelAndView modelAndView = new ModelAndView("login.html");
        return modelAndView;
    }

    @RequestMapping("/hello")
    public ModelAndView hello() {
        return new ModelAndView("hello.html");
    }
}
