describe('Map and markers appears visible', () => {
    it('visit the / url', () => {
      cy.visit('/')
      cy.wait(1000);
      cy.get('.mgl-map-wrapper').should('be.visible')
      cy.get('.mapboxgl-canvas').should('be.visible')
      cy.get('.mapboxgl-marker').should('be.visible')
    })
  })
  